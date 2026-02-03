<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500">New Mission</p>
            <h2 class="text-2xl font-semibold text-slate-900">
                {{ __('Create Task') }}
            </h2>
        </div>
    </x-slot>

    <div class="glass-card p-6 lg:p-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Create Task</h1>
                <p class="mt-1 text-sm text-slate-600">Capture every detail so nothing slips past your radar.</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="fancy-button-ghost">Back to Tasks</a>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}" class="mt-6 space-y-6">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Title</label>
                    <input name="title"
                           type="text"
                           value="{{ old('title') }}"
                           placeholder="Design quarterly roadmap"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700"
                           required>
                </div>

                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Category</label>
                    <input name="category"
                           type="text"
                           value="{{ old('category') }}"
                           placeholder="Work, Personal, Growth"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Description</label>
                <textarea name="description"
                          rows="4"
                          placeholder="Add details, links, or supporting notes."
                          class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">{{ old('description') }}</textarea>
            </div>

            <div class="grid gap-6 lg:grid-cols-4">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Due Date</label>
                    <input name="due_date"
                           type="date"
                           value="{{ old('due_date') }}"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Priority</label>
                    <select name="priority" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                        <option value="urgent" @selected(old('priority') === 'urgent')>Urgent</option>
                        <option value="high" @selected(old('priority') === 'high')>High</option>
                        <option value="medium" @selected(old('priority', 'medium') === 'medium')>Medium</option>
                        <option value="low" @selected(old('priority') === 'low')>Low</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Estimated Minutes</label>
                    <input name="estimated_minutes"
                           type="number"
                           min="1"
                           value="{{ old('estimated_minutes') }}"
                           placeholder="60"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Reminder</label>
                    <input name="reminder_at"
                           type="datetime-local"
                           value="{{ old('reminder_at') }}"
                           class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tags</label>
                <input name="tags"
                       type="text"
                       value="{{ old('tags') }}"
                       placeholder="design, sprint, backend"
                       class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-700">
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="fancy-button-primary">
                    Create Task
                </button>

                <a href="{{ route('tasks.index') }}" class="fancy-button-ghost">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
