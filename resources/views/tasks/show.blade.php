<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <h1 class="text-2xl mb-4">{{ $task->title }}</h1>

    <div class="bg-white shadow rounded p-6">
        <p class="mb-4 text-gray-800">
            {{ $task->description }}
        </p>

        <div class="text-sm text-gray-600 space-y-1">
            <div>
                <strong>Created:</strong>
                {{ $task->created_at->format('M d, Y H:i') }}
            </div>

            @if ($task->due_date)
                <div>
                    <strong>Due:</strong>
                    {{ $task->due_date->format('M d, Y') }}
                </div>
            @endif

            <div>
                <strong>Status:</strong>
                <span class="{{ $task->is_complete ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ $task->is_complete ? 'Completed' : 'Pending' }}
                </span>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-3">
            <a href="{{ route('tasks.edit', $task) }}"
               class="px-4 py-2 border rounded">
                Edit
            </a>

            <a href="{{ route('tasks.index') }}"
               class="text-gray-600">
                Back
            </a>
        </div>
    </div>
</x-app-layout>
