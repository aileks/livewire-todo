<div class="flex flex-col justify-center h-screen">
    <div class="flex flex-col items-center justify-center p-4 m-auto border rounded-sm bg-slate-700">
        <header>
            <h1 class="text-2xl font-bold underline">To-Do List</h1>
        </header>

        <ul class="list-insde">
            @foreach ($todos as $todo)
                <li class="p-2 m-2 text-gray-800 rounded shadow bg-slate-300">
                    <input
                        type="checkbox"
                        wire:model="todo.completed"
                        wire:click="updateTodo({{ $todo->id }})"
                        {{ $todo->completed ? 'checked' : '' }}
                    >
                    <span class="{{ $todo->completed ? 'line-through' : '' }}">{{ $todo->task }}</span>
                </li>
            @endforeach
        </ul>

        <form
            class="text-black"
            wire:submit.prevent="addTodo"
        >
            <input
                class="p-2 m-2 border rounded-sm border-slate-700"
                type="text"
                wire:model="task"
                placeholder="New Task"
            >
            <button
                class="px-4 py-2 m-1 text-white transition-all duration-300 rounded-sm hover:bg-emerald-800 bg-emerald-700"
            >
                Add
            </button>
        </form>
    </div>
</div>
