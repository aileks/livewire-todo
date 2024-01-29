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
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#475569"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect
                        x="3"
                        y="3"
                        width="18"
                        height="18"
                        rx="2"
                        ry="2"
                    ></rect>
                    <line
                        x1="9"
                        y1="9"
                        x2="15"
                        y2="9"
                    ></line>
                    <line
                        x1="9"
                        y1="13"
                        x2="15"
                        y2="13"
                    ></line>
                    <line
                        x1="9"
                        y1="17"
                        x2="15"
                        y2="17"
                    ></line>
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
