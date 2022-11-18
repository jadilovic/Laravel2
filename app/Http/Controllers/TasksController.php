<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{

    public function index() {
        $tasks = auth()->user()->tasks;
        // $foundTask = $tasks['0'];
        return view('dashboard', compact('tasks'));
    }

    public function add() {
        return view('add');
    }

    public function search(Request $request) {
        // var_dump('test');
        // $this->validate($request, [
        //     'search' => 'required|min:3'
        // ]);
        // $tasks = auth()->user()->tasks;
        // $foundTask = $tasks->first(function($task, $request) {
        //     return $task->title == $request->search;
        // });
        // var_dump($foundTask->title);
        return redirect('/dashboard');
    }

    public function create(Request $request) {
        $this->validate($request, [
            'description' => 'required|min:10|unique:tasks'
        ]);

        $task = new Task;
        $task->description = $request->description;
        $task->title = $request->title;
        $task->user_id = auth()->user()->id;
        $task->save();
        return redirect('/dashboard');
    }

    public function edit(Task $task) {
        if (auth()->user()->id == $task->user_id) {
            return view('edit', compact('task'));
        } else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, Task $task) {
        if (isset($_POST['delete'])) {
            $task->delete();
            return redirect('/dashboard');
        } else {
            $this->validate($request, [
                'description' => 'required|min:10|unique:tasks'
            ]);
            $task->description = $request->description;
            $task->save();
            return redirect('/dashboard');
        }
    }


}
