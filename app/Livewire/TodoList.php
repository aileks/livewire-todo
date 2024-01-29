<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class TodoList extends Component
{
    public $task;
    public $newTask;

    public function addTodo() // create
    {
        $this->validate([
            'newTask' => 'required|max:100'
        ]);

        Todo::create(['task' => $this->newTask, 'completed' => false]);
        $this->newTask = '';
    }

    public function render() // read
    {
        return view('livewire.todo-list', ['todos' => Todo::all()]);
    }

    public function startEditing(Todo $todo)
    {
        $this->task = $todo->task;
        $todo->update(['editing' => true]);
    }

    public function stopEditing(Todo $todo)
    {
        $this->task = '';
        $todo->update(['editing' => false]);
    }

    public function updateTodo($id) // update
    {
        $todo = Todo::find($id);
        $todo->update(['task' => $this->task]);
        $todo->update(['editing' => false]);
        $this->task = '';
        session()->flash('message', 'Task successfully updated!');
    }

    public function completeTodo(Todo $todo) //update
    {
        $todo->update(['completed' => !$todo->completed]);
    }

    public function deleteTodo(Todo $todo) // delete
    {
        $todo->delete();
    }
}
