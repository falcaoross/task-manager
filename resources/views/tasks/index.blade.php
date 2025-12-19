<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">My Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            Create Task
        </a>
    </div>

    @if ($tasks->count())
        <div class="space-y-4">
            @foreach ($tasks as $task)
                <div class="p-4 bg-white shadow rounded flex justify-between items-center">
                    <div>
                        <a href="{{ route('tasks.show', $task) }}"
                           class="font-medium text-lg {{ $task->is_complete ? 'line-through text-gray-400' : '' }}">
                            {{ $task->title }}
                        </a>

                        @if($task->due_date)
                            <div class="text-sm text-gray-500">
                                Due: {{ $task->due_date->format('M d, Y') }}
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center space-x-2">
                        <!-- Mark Complete / Incomplete -->
                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_complete" value="{{ $task->is_complete ? 0 : 1 }}">
                            <button type="submit" class="px-3 py-1 border rounded text-sm">
                                {{ $task->is_complete ? 'Mark Incomplete' : 'Mark Complete' }}
                            </button>
                        </form>

                        <!-- Edit -->
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="px-3 py-1 border rounded text-sm">
                            Edit
                        </a>

                        <!-- Delete -->
                        <form method="POST"
                              action="{{ route('tasks.destroy', $task) }}"
                              onsubmit="return confirm('Delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 border rounded text-sm text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
    @else
        <p>
            No tasks yet.
            <a href="{{ route('tasks.create') }}" class="text-blue-600">
                Create your first task
            </a>
        </p>
    @endif
</x-app-layout>
