<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $now = Carbon::now();
        $baseQuery = Auth::user()->tasks();

        $tasksQuery = Auth::user()->tasks();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $tasksQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->string('status')->toString();
            if ($status === 'completed') {
                $tasksQuery->where('is_complete', true);
            } elseif ($status === 'pending') {
                $tasksQuery->where('is_complete', false);
            } elseif ($status === 'overdue') {
                $tasksQuery->where('is_complete', false)
                    ->whereNotNull('due_date')
                    ->whereDate('due_date', '<', $now->toDateString());
            } elseif ($status === 'due_today') {
                $tasksQuery->whereDate('due_date', $now->toDateString());
            } elseif ($status === 'due_week') {
                $tasksQuery->whereBetween('due_date', [
                    $now->toDateString(),
                    $now->copy()->addDays(7)->toDateString(),
                ]);
            }
        }

        if ($request->filled('priority')) {
            $tasksQuery->where('priority', $request->string('priority')->toString());
        }

        if ($request->filled('category')) {
            $tasksQuery->where('category', $request->string('category')->toString());
        }

        $sort = $request->string('sort', 'created_desc')->toString();
        if ($sort === 'created_asc') {
            $tasksQuery->orderBy('created_at');
        } elseif ($sort === 'due_asc') {
            $tasksQuery->orderByRaw('due_date is null, due_date asc');
        } elseif ($sort === 'due_desc') {
            $tasksQuery->orderByRaw('due_date is null, due_date desc');
        } elseif ($sort === 'title') {
            $tasksQuery->orderBy('title');
        } else {
            $tasksQuery->orderBy('created_at', 'desc');
        }

        $tasks = $tasksQuery->paginate(10)->withQueryString();

        $total = (clone $baseQuery)->count();
        $completed = (clone $baseQuery)->where('is_complete', true)->count();
        $pending = (clone $baseQuery)->where('is_complete', false)->count();
        $overdueCount = (clone $baseQuery)
            ->where('is_complete', false)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', $now->toDateString())
            ->count();
        $dueToday = (clone $baseQuery)
            ->whereNotNull('due_date')
            ->whereDate('due_date', $now->toDateString())
            ->count();
        $dueWeek = (clone $baseQuery)
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [
                $now->toDateString(),
                $now->copy()->addDays(7)->toDateString(),
            ])
            ->count();

        $stats = [
            'total' => $total,
            'completed' => $completed,
            'pending' => $pending,
            'overdue' => $overdueCount,
            'due_today' => $dueToday,
            'due_week' => $dueWeek,
            'progress' => $total ? (int) round(($completed / $total) * 100) : 0,
        ];

        $upcomingTasks = (clone $baseQuery)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', $now->toDateString())
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        $overdueTasks = (clone $baseQuery)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', $now->toDateString())
            ->where('is_complete', false)
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        $categories = (clone $baseQuery)
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('tasks.index', compact('tasks', 'stats', 'upcomingTasks', 'overdueTasks', 'categories'));
    }

    // GET /tasks/create
    public function create()
    {
        return view('tasks.create');
    }

    // POST /tasks
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'category' => 'nullable|max:100',
            'tags' => 'nullable|max:255',
            'estimated_minutes' => 'nullable|integer|min:1|max:10080',
            'reminder_at' => 'nullable|date',
        ]);

        $validated['priority'] = $validated['priority'] ?? 'medium';

        $task = new Task($validated);
        $task->user_id = Auth::id();
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // GET /tasks/{task}
    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    // GET /tasks/{task}/edit
    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    // PUT/PATCH /tasks/{task}
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        // CASE 1: Only toggling completion status
        if ($request->has('is_complete') && $request->keys() === ['_token', '_method', 'is_complete']) {
            $task->update([
                'is_complete' => $request->boolean('is_complete'),
            ]);

            return redirect()->route('tasks.index')
                ->with('success', 'Task status updated.');
        }

        // CASE 2: Full task update (edit form)
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'category' => 'nullable|max:100',
            'tags' => 'nullable|max:255',
            'estimated_minutes' => 'nullable|integer|min:1|max:10080',
            'reminder_at' => 'nullable|date',
            'is_complete' => 'sometimes|boolean',
        ]);

        $validated['priority'] = $validated['priority'] ?? 'medium';

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    // DELETE /tasks/{task}
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    /**
     * Ensure the authenticated user owns the task.
     */
    protected function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
