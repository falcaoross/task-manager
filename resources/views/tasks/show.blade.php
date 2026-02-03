<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500">Task Spotlight</p>
            <h2 class="text-2xl font-semibold text-slate-900">
                {{ __('Task Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="glass-card p-6 lg:p-8">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">{{ $task->title }}</h1>
                <p class="mt-2 text-sm text-slate-600">Dive into the details and keep momentum clear.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <span class="{{ $task->is_complete ? 'badge-complete' : 'badge-pending' }}">
                    {{ $task->is_complete ? 'Completed' : 'In Progress' }}
                </span>
                <span class="badge bg-slate-100 text-slate-700">
                    {{ ucfirst($task->priority ?? 'medium') }}
                </span>
            </div>
        </div>

        <div class="mt-6 grid gap-6 lg:grid-cols-[2fr_1fr]">
            <div class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white/80 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Description</h3>
                    <p class="mt-3 text-sm text-slate-700">
                        {{ $task->description ?: 'No description added yet.' }}
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white/80 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Details</h3>
                    <div class="mt-4 grid gap-3 text-sm text-slate-700">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-500">Created</span>
                            <span>{{ $task->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        @if ($task->due_date)
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-slate-500">Due Date</span>
                                <span>{{ $task->due_date->format('M d, Y') }}</span>
                            </div>
                        @endif
                        @if ($task->category)
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-slate-500">Category</span>
                                <span>{{ $task->category }}</span>
                            </div>
                        @endif
                        @if ($task->estimated_minutes)
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-slate-500">Estimated Time</span>
                                <span>{{ $task->estimated_minutes }} minutes</span>
                            </div>
                        @endif
                        @if ($task->reminder_at)
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-slate-500">Reminder</span>
                                <span>{{ $task->reminder_at->format('M d, Y H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($task->tags)
                    @php
                        $tags = collect(explode(',', $task->tags))->map(fn ($tag) => trim($tag))->filter();
                    @endphp
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-5">
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Tags</h3>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach ($tags as $tag)
                                <span class="badge bg-slate-100 text-slate-700">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div class="rounded-2xl border border-indigo-200 bg-indigo-50/80 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-indigo-500">Momentum</h3>
                    <p class="mt-3 text-sm text-indigo-700">Keep your next action ready. The best time to advance is now.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white/80 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Actions</h3>
                    <div class="mt-4 flex flex-col gap-2">
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="fancy-button-primary justify-center">
                            Edit Task
                        </a>
                        <a href="{{ route('tasks.index') }}"
                           class="fancy-button-ghost justify-center">
                            Back to Tasks
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
