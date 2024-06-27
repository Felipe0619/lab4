<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {

        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create()
    {

        return view('tasks.create');
    }

    public function show(Task $task)
    {

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function store()
    {

        // $task = new Task();

        // $task->name = request('name'); 
        // $task->description = request('description');

        // $task->save();
        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3']
        ]);

        Task::create($data);

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {

        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    public function update(Task $task)
    {

        $data = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3']
        ]);

       $task->fill($data)->save();
       //$task->update($data);

        return redirect('/tasks/' . $task->id);
    }
    public function destroy(Task $task)
{
    $task->delete();

    return redirect('/tasks');
}
public function complete(Task $task)
{
    $task->completed = true;
    $task->save();

    return redirect('/tasks')->with('success', 'Tarea completada con éxito');
}

}
