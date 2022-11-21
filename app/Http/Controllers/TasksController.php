<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

function log_to_console($data, bool $quotes = true) {
    $output = json_encode($data);
    if ($quotes) {
        echo "<script>console.log('{$output}' );</script>";
    } else {
        echo "<script>console.log({$output} );</script>";
    }
}

class TasksController extends Controller
{

    public function index() {
        $tasks = auth()->user()->tasks;
        $calc = "15" + 3;
        $ter = $calc > 10 ? "vece" : "manje";
        $ter .= " i vece";
        $arr = array(3 => "boob", 4 => "cool", 7 => "too");
        $arr2 = array();
        $arr2[] = "aki";
        $arr2[] = "cuni";
        $arr2[] = "adian";
        $arr2[] = "ali";
        foreach($arr2 as $k => $v) {
            log_to_console("Key: " . $k . ", Value: " . $v);
        }
        log_to_console($arr2);
        log_to_console(is_array($arr2));
        return view('dashboard', compact('tasks'));
    }

    public function add() {
        $isChecked = true;
        $versions = ['a', 'b', 'c', 'd'];
        return view('add', compact('isChecked', 'versions'));
    }

    public function search(Request $request) {
        $this->validate($request, [
            'search' => 'required|min:3'
        ]);

        $foundTask = new Task();
        $tasks = auth()->user()->tasks;
        foreach ($tasks as $value) {
            if ($value->title == $request->search) {
                $foundTask = $value;
            }
        }
        if (!$foundTask->title) {
            $foundTask->title = "Not task found with entred title";
        }
        return view('/dashboard', compact('tasks', 'foundTask'));
    }

    public function create(Request $request) {
        $this->validate($request, [
            'description' => 'required|min:10|unique:tasks'
        ]);

        $task = new Task();
        $task->description = $request->description;
        $task->title = $request->title;
        $task->user_id = auth()->user()->id;
        $task->save();
        return redirect('/dashboard');
    }

    public function edit(Task $task) {
        log_to_console($task, false);

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
        } else if ($request->description == $task->description) {
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
