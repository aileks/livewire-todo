{{-- TODO: Add animations/transitions --}}
<div
    class="flex flex-col items-center p-8 m-auto mt-16 border rounded-lg lg:w-1/3 sm:w-full shadow-light border-slate-800 bg-slate-800">
    <header class="mb-6">
        <h1 class="text-4xl font-bold underline">To-Do List</h1>
    </header>

    <form
        class="text-gray-800"
        wire:submit.prevent="addTask"
    >
        @csrf
        <input
            class="p-2 m-2 border rounded-sm border-slate-700"
            type="text"
            wire:model="newTask"
            placeholder="New Task"
        >
    </form>

    <div class="w-3/4 p-2 m-2 text-gray-800 rounded shadow bg-slate-200">
        @if ($todos->isEmpty())
            <div class="text-xl text-center text-gray-800">
                No tasks yet. Add a new task above.
                <svg
                    class="mx-auto mt-6"
                    xmlns="http://www.w3.org/2000/svg"
                    width="256"
                    height="256"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"
                    />
                    <path
                        d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"
                    />
                    <path
                        d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"
                    />
                </svg>
            </div>
        @else
            <ul class="list-insde">
                @foreach ($todos as $todo)
                    <span class="text-sm font-bold text-gray-500">
                        Added {{ $todo->created_at->format('M j') }}
                    </span>
                    <li
                        class="text-lg"
                        wire:dblclick="startEditing({{ $todo->id }})"
                    >
                        @if ($todo->editing)
                            <input
                                class="mr-1"
                                type="text"
                                wire:model="task"
                                wire:keydown.enter="updateTodo({{ $todo->id }})"
                                wire:keydown.escape="stopEditing({{ $todo->id }})"
                                wire:click.away="updateTodo({{ $todo->id }})"
                                x-data
                                x-ref="inputField"
                                x-init="$refs.inputField.focus()"
                            >
                        @else
                            <input
                                class="mr-1"
                                type="checkbox"
                                wire:model="completed"
                                wire:click="completeTodo({{ $todo->id }})"
                                {{ $todo->completed ? 'checked' : '' }}
                            >
                            <span class="{{ $todo->completed ? 'line-through' : '' }}">{{ $todo->task }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-6">
        <x-button
            class="mx-6 text-sm text-gray-300 bg-sky-900"
            wire:click="markAllAsCompleted"
        >
            Mark All As Completed
        </x-button>
        <x-button
            class="mx-6 text-sm text-gray-300 bg-sky-900"
            wire:click="removeCompleted"
        >
            Remove Completed
        </x-button>
    </div>

    @if (session()->has('message'))
        <div
            class="fixed top-0 right-0 p-2 mt-6 mr-6 rounded text-emerald-800 bg-emerald-300"
            x-data="{ show: false }"
            x-show="show"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-0"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-0"
            x-init="setTimeout(() => show = true, 50);
            setTimeout(() => show = false, 2500)"
        >
            {{ session('message') }}
        </div>
    @endif
</div>
