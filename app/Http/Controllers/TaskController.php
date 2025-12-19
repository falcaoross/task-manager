<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index()
    {
        // Get tasks for the authenticated user, newest first
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->paginate(10);

        return view('tasks.index', compact('tasks'));
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
        ]);

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
        'is_complete' => 'sometimes|boolean',
    ]);

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
