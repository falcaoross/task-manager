<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500">Refine Mission</p>
            <h2 class="text-2xl font-semibold text-slate-900">
                {{ __('Edit Task') }}
            </h2>
        </div>
    </x-slot>

    <div class="glass-card p-6 lg:p-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Edit Task</h1>
                <p class="mt-1 text-sm text-slate-600">Update priorities, timings, or details in a single space.</p>
            </div>
            <a href="{{ route('tasks.show', $task) }}" class="fancy-button-ghost">View Task</a>
        </div>

        <form method="POST"
              action="{{ route('tasks.update', $task) }}"
              class="mt-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Title</label>
                    <input name="title"
                           type="text"
                           value="{{ old('title', $task->title) }}"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700"
                           required>
                </div>

                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Category</label>
                    <input name="category"
                           type="text"
                           value="{{ old('category', $task->category) }}"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Description</label>
                <textarea name="description"
                          rows="4"
                          class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="grid gap-6 lg:grid-cols-4">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Due Date</label>
                    <input name="due_date"
                           type="date"
                           value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Priority</label>
                    <select name="priority" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                        <option value="urgent" @selected(old('priority', $task->priority) === 'urgent')>Urgent</option>
                        <option value="high" @selected(old('priority', $task->priority) === 'high')>High</option>
                        <option value="medium" @selected(old('priority', $task->priority) === 'medium')>Medium</option>
                        <option value="low" @selected(old('priority', $task->priority) === 'low')>Low</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Estimated Minutes</label>
                    <input name="estimated_minutes"
                           type="number"
                           min="1"
                           value="{{ old('estimated_minutes', $task->estimated_minutes) }}"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Reminder</label>
                    <input name="reminder_at"
                           type="datetime-local"
                           value="{{ old('reminder_at', $task->reminder_at?->format('Y-m-d\\TH:i')) }}"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tags</label>
                <input name="tags"
                       type="text"
                       value="{{ old('tags', $task->tags) }}"
                       class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
            </div>

            <div>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox"
                           name="is_complete"
                           value="1"
                           class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                           {{ old('is_complete', $task->is_complete) ? 'checked' : '' }}>
                    <span class="text-sm font-medium text-slate-700">Mark as completed</span>
                </label>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit"
                        class="fancy-button-primary">
                    Update Task
                </button>

                <a href="{{ route('tasks.index') }}"
                   class="fancy-button-ghost">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
