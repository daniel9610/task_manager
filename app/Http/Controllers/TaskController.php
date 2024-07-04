<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function home()
    {
        return redirect()->route('tasks.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), [
                'priority' => 'required',
                'deadline' => 'required',
                'title' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:255'],
            ]);
            if ($validation->fails()) {
                flash($validation->errors())->error();
                return redirect()->back();
            }
            $new_task = new Task;
            $new_task->user_id = auth()->id();
            $new_task->title = $request->title;
            $new_task->description = $request->description;
            $new_task->priority = $request->priority;
            $new_task->done = false;
            $new_task->deadline = $request->deadline;
            $new_task->save();
            flash('Task created successfully!')->success();
            return redirect()->back();
        }catch(Exception $e){
            flash('Something went wrong')->error();
            return $e;
        }  
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'priority' => 'required',
            'deadline' => 'required',
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
        ]);
        if ($validation->fails()) {
            flash($validation->errors())->error();
            return redirect()->back();
        }
        $task_id = $request->task_id;
        $new_task = Task::find($task_id);
        $new_task->title = $request->title;
        $new_task->description = $request->description;
        $new_task->priority = $request->priority;
        $new_task->done = $request->done;
        $new_task->deadline = $request->deadline;
        $new_task->save(); 
        return response()->json('Task updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $task_id = $request->task_id;
        $task = Task::find($task_id);
        if(auth()->user()->role == 'admin' || auth()->id() == $task->user_id){
            $task->delete();  
            flash('Task deleted successfully!')->success();
            return redirect()->back(); 
        }
        flash('forbidden action!')->error();
        return redirect()->back(); 
    }

    public function markAsDone(Request $request)
    {
    try{
            $task_id = $request->task_id;
            $task = Task::find($task_id);
            if($task->done == false){
                $task->done = true;
            }else{
                $task->done = false;
            }
            $task->save();
            flash('Task updated successfully!')->success();
            return redirect()->back();
        }catch(Exception $e){
            flash('Something went wrong')->error();
            return $e;
        }
    }
}
