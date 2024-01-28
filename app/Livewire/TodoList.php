<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class TodoList extends Component
{
    public $task;

    public function addTodo() // create
    {
        $this->validate([
            'task' => 'required'
        ]);

        Todo::create(['task' => $this->task, 'completed' => false]);
        $this->task = '';
    }

    public function render() // read
    {
        return view('livewire.todo-list', ['todos' => Todo::all()]);
    }

    public function editTodo($id) //update
    {
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function deleteTodo($id) // delete
    {
        $todo = Todo::find($id);
        $todo->delete();

    }
}
