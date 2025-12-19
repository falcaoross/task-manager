<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <h1 class="text-2xl mb-4">Edit Task</h1>

    <form method="POST"
          action="{{ route('tasks.update', $task) }}"
          class="space-y-4 bg-white p-6 shadow rounded-lg">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Title</label>
            <input name="title"
                   type="text"
                   value="{{ old('title', $task->title) }}"
                   class="mt-1 block w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium">Description</label>
            <textarea name="description"
                      rows="4"
                      class="mt-1 block w-full border rounded px-3 py-2">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium">Due Date</label>
            <input name="due_date"
                   type="date"
                   value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                   class="mt-1 block border rounded px-3 py-2">
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox"
                       name="is_complete"
                       value="1"
                       {{ old('is_complete', $task->is_complete) ? 'checked' : '' }}>
                <span class="ml-2 text-sm">Completed</span>
            </label>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded">
                Update
            </button>

            <a href="{{ route('tasks.index') }}"
               class="text-gray-600">
                Cancel
            </a>
        </div>
    </form>
</x-app-l
