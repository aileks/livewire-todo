<div class="flex mt-24">
    <div class="flex flex-col items-center p-8 m-auto border rounded-sm shadow-light border-slate-800 bg-slate-800">
        <header class="mb-8">
            <h1 class="text-2xl font-bold underline">To-Do List</h1>
        </header>

        <ul class="list-insde">
            <div class="p-2 m-2 text-gray-800 rounded shadow bg-slate-200">
                @foreach ($todos as $todo)
                    <li wire:dblclick="editTodo({{ $todo->id }})">
                        <input
                            class="mr-1"
                            type="checkbox"
                            wire:model="todo.completed"
                            wire:click="updateTodo({{ $todo->id }})"
                            {{ $todo->completed ? 'checked' : '' }}
                        >
                        <span class="{{ $todo->completed ? 'line-through' : '' }}">{{ $todo->task }}</span>
                    </li>
                @endforeach
            </div>
        </ul>

        <form
            class="mt-6 text-gray-800"
            wire:submit.prevent="addTodo"
        >
            <input
                class="p-2 m-2 border rounded-sm border-slate-700"
                type="text"
                wire:model="task"
                placeholder="New Task"
            >
            <x-button class="px-4 py-2 hover:bg-emerald-800 bg-emerald-700">
                Add
            </x-button>
        </form>
    </div>
</div>
