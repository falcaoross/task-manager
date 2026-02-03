<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500">Command Center</p>
                <h2 class="text-2xl font-semibold text-slate-900">
                    {{ __('My Task Universe') }}
                </h2>
                <p class="mt-1 text-sm text-slate-600">Stay ahead with smart filters, focus zones, and a crystal-clear overview.</p>
            </div>
            <a href="{{ route('tasks.create') }}" class="fancy-button-primary">
                <span>✨ Create Task</span>
            </a>
        </div>
    </x-slot>

    @php
        $priorityStyles = [
            'low' => 'badge-low',
            'medium' => 'badge-medium',
            'high' => 'badge-high',
            'urgent' => 'badge-urgent',
        ];
    @endphp

    <section class="glass-card p-6 lg:p-8">
        <div class="grid gap-6 lg:grid-cols-[2fr_1fr]">
            <div>
                <h3 class="text-xl font-semibold text-slate-900">Daily Pulse</h3>
                <p class="mt-2 text-sm text-slate-600">Track your momentum and keep every goal in orbit.</p>
                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total Tasks</p>
                        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Completed</p>
                        <p class="mt-2 text-2xl font-semibold text-emerald-600">{{ $stats['completed'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pending</p>
                        <p class="mt-2 text-2xl font-semibold text-amber-600">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Overdue</p>
                        <p class="mt-2 text-2xl font-semibold text-rose-600">{{ $stats['overdue'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Due Today</p>
                        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $stats['due_today'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Next 7 Days</p>
                        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $stats['due_week'] }}</p>
                    </div>
                </div>
            </div>
            <div class="rounded-3xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 p-6 text-white shadow-lg shadow-indigo-500/30">
                <h4 class="text-lg font-semibold">Completion Flow</h4>
                <p class="mt-2 text-sm text-white/80">A quick look at your momentum today.</p>
                <div class="mt-6">
                    <div class="flex items-center justify-between text-sm font-semibold">
                        <span>Progress</span>
                        <span>{{ $stats['progress'] }}%</span>
                    </div>
                    <div class="mt-3 h-2 rounded-full bg-white/30">
                        <div class="h-2 rounded-full bg-white" style="width: {{ $stats['progress'] }}%"></div>
                    </div>
                </div>
                <div class="mt-6 space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span>Focus Mode</span>
                        <span class="font-semibold">Enabled</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Next Reminder</span>
                        <span class="font-semibold">Auto</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]">
        <div class="space-y-6">
            <div class="glass-panel p-5">
                <form method="GET" action="{{ route('tasks.index') }}" class="grid gap-4 lg:grid-cols-12">
                    <div class="lg:col-span-4">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Search</label>
                        <input name="search" type="text" value="{{ request('search') }}" placeholder="Search tasks, notes, or tags"
                               class="mt-2 w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-2 text-sm text-slate-700 focus:border-indigo-400 focus:ring-indigo-400">
                    </div>
                    <div class="lg:col-span-2">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</label>
                        <select name="status" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white/80 px-3 py-2 text-sm text-slate-700">
                            <option value="">All</option>
                            <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                            <option value="overdue" @selected(request('status') === 'overdue')>Overdue</option>
                            <option value="due_today" @selected(request('status') === 'due_today')>Due Today</option>
                            <option value="due_week" @selected(request('status') === 'due_week')>Due This Week</option>
                        </select>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Priority</label>
                        <select name="priority" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white/80 px-3 py-2 text-sm text-slate-700">
                            <option value="">Any</option>
                            <option value="urgent" @selected(request('priority') === 'urgent')>Urgent</option>
                            <option value="high" @selected(request('priority') === 'high')>High</option>
                            <option value="medium" @selected(request('priority') === 'medium')>Medium</option>
                            <option value="low" @selected(request('priority') === 'low')>Low</option>
                        </select>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Category</label>
                        <select name="category" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white/80 px-3 py-2 text-sm text-slate-700">
                            <option value="">Any</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="lg:col-span-2">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Sort</label>
                        <select name="sort" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white/80 px-3 py-2 text-sm text-slate-700">
                            <option value="created_desc" @selected(request('sort', 'created_desc') === 'created_desc')>Newest</option>
                            <option value="created_asc" @selected(request('sort') === 'created_asc')>Oldest</option>
                            <option value="due_asc" @selected(request('sort') === 'due_asc')>Due Soon</option>
                            <option value="due_desc" @selected(request('sort') === 'due_desc')>Due Latest</option>
                            <option value="title" @selected(request('sort') === 'title')>Title</option>
                        </select>
                    </div>
                    <div class="lg:col-span-12 flex flex-wrap gap-3">
                        <button type="submit" class="fancy-button-primary">Apply Filters</button>
                        <a href="{{ route('tasks.index') }}" class="fancy-button-ghost">Reset</a>
                    </div>
                </form>
            </div>

            @if ($tasks->count())
                <div class="space-y-4">
                    @foreach ($tasks as $task)
                        <div class="glass-panel p-5">
                            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                <div class="space-y-3">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <a href="{{ route('tasks.show', $task) }}"
                                           class="text-lg font-semibold text-slate-900 {{ $task->is_complete ? 'line-through text-slate-400' : '' }}">
                                            {{ $task->title }}
                                        </a>
                                        <span class="{{ $task->is_complete ? 'badge-complete' : 'badge-pending' }}">
                                            {{ $task->is_complete ? 'Completed' : 'In Progress' }}
                                        </span>
                                        <span class="{{ $priorityStyles[$task->priority ?? 'medium'] ?? 'badge-medium' }}">
                                            {{ ucfirst($task->priority ?? 'medium') }}
                                        </span>
                                    </div>

                                    @if ($task->description)
                                        <p class="text-sm text-slate-600">{{ $task->description }}</p>
                                    @endif

                                    <div class="flex flex-wrap items-center gap-4 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                        <span>Created {{ $task->created_at->format('M d, Y') }}</span>
                                        @if($task->due_date)
                                            <span>Due {{ $task->due_date->format('M d, Y') }}</span>
                                        @endif
                                        @if($task->category)
                                            <span>Category: {{ $task->category }}</span>
                                        @endif
                                        @if($task->estimated_minutes)
                                            <span>Est. {{ $task->estimated_minutes }} min</span>
                                        @endif
                                    </div>

                                    @if($task->tags)
                                        @php
                                            $tags = collect(explode(',', $task->tags))->map(fn ($tag) => trim($tag))->filter();
                                        @endphp
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($tags as $tag)
                                                <span class="badge bg-slate-100 text-slate-700">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center gap-2">
                                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_complete" value="{{ $task->is_complete ? 0 : 1 }}">
                                        <button type="submit" class="fancy-button-ghost">
                                            {{ $task->is_complete ? 'Mark Incomplete' : 'Mark Complete' }}
                                        </button>
                                    </form>

                                    <a href="{{ route('tasks.edit', $task) }}" class="fancy-button-ghost">Edit</a>

                                    <form method="POST"
                                          action="{{ route('tasks.destroy', $task) }}"
                                          onsubmit="return confirm('Delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fancy-button-ghost text-rose-600 hover:text-rose-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $tasks->links() }}
                </div>
            @else
                <div class="glass-panel p-6 text-center">
                    <p class="text-sm text-slate-600">
                        No tasks yet. Create your first mission and start building momentum.
                    </p>
                    <a href="{{ route('tasks.create') }}" class="mt-4 inline-flex fancy-button-primary">
                        Create your first task
                    </a>
                </div>
            @endif
        </div>

        <aside class="space-y-6">
            <div class="glass-panel p-5">
                <h3 class="text-lg font-semibold text-slate-900">Upcoming Launches</h3>
                <p class="mt-1 text-sm text-slate-600">Tasks scheduled for the next milestones.</p>
                <div class="mt-4 space-y-3">
                    @forelse ($upcomingTasks as $task)
                        <a href="{{ route('tasks.show', $task) }}" class="block rounded-2xl border border-slate-200 bg-white/70 px-4 py-3">
                            <div class="flex items-center justify-between text-sm font-semibold text-slate-900">
                                <span>{{ $task->title }}</span>
                                <span class="text-xs text-slate-500">{{ $task->due_date?->format('M d') }}</span>
                            </div>
                            <div class="mt-1 text-xs text-slate-500">Priority: {{ ucfirst($task->priority) }}</div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">No upcoming tasks. Enjoy the clear skies.</p>
                    @endforelse
                </div>
            </div>

            <div class="glass-panel p-5">
                <h3 class="text-lg font-semibold text-slate-900">Overdue Radar</h3>
                <p class="mt-1 text-sm text-slate-600">Quickly resurface tasks that need attention.</p>
                <div class="mt-4 space-y-3">
                    @forelse ($overdueTasks as $task)
                        <a href="{{ route('tasks.show', $task) }}" class="block rounded-2xl border border-rose-200 bg-rose-50/70 px-4 py-3">
                            <div class="flex items-center justify-between text-sm font-semibold text-rose-700">
                                <span>{{ $task->title }}</span>
                                <span class="text-xs">{{ $task->due_date?->format('M d') }}</span>
                            </div>
                            <div class="mt-1 text-xs text-rose-600">Overdue</div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">No overdue tasks. Keep it up!</p>
                    @endforelse
                </div>
            </div>

            <div class="glass-panel p-5">
                <h3 class="text-lg font-semibold text-slate-900">Productivity Rituals</h3>
                <ul class="mt-3 space-y-3 text-sm text-slate-600">
                    <li>🔔 Auto reminders based on your schedule.</li>
                    <li>🎯 Spotlight filters for deep work sessions.</li>
                    <li>🧠 Weekly review prompts to stay aligned.</li>
                </ul>
            </div>
        </aside>
    </section>
</x-app-layout>
