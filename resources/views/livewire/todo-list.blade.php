<div class="flex mt-24">
    <div
        class="flex flex-col items-center w-1/3 p-8 m-auto border rounded-sm shadow-light border-slate-800 bg-slate-800">
        <header class="mb-8">
            <h1 class="text-2xl font-bold underline">To-Do List</h1>
        </header>

        <div class="w-[85%] p-2 m-2 text-gray-800 rounded shadow bg-slate-200">
            <ul class="list-insde">
                @foreach ($todos as $todo)
                    <span class="text-xs font-bold text-gray-500">
                        Added {{ $todo->created_at->format('M j') }}
                    </span>
                    <li wire:dblclick="startEditing({{ $todo->id }})">
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
                                wire:model="todo.completed"
                                wire:click="completeTodo({{ $todo->id }})"
                                {{ $todo->completed ? 'checked' : '' }}
                            >
                            <span class="{{ $todo->completed ? 'line-through' : '' }}">{{ $todo->task }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <form
            class="mt-6 text-gray-800"
            wire:submit.prevent="addTodo"
        >
            <input
                class="p-2 m-2 border rounded-sm border-slate-700"
                type="text"
                wire:model="newTask"
                placeholder="New Task"
            >
            <x-button
                class="px-4 py-2 hover:bg-emerald-800 bg-emerald-700"
                type="submit"
            >
                Add
            </x-button>
        </form>
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
