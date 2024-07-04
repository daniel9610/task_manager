<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->paginate(3);
        return response()->json($tasks, 200);
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
                return response()->json($validation->errors(), 500);
            }
            $new_task = new Task;
            $new_task->user_id = auth()->id();
            $new_task->title = $request->title;
            $new_task->description = $request->description;
            $new_task->priority = $request->priority;
            $new_task->done = false;
            $new_task->deadline = $request->deadline;
            $new_task->save();
            return response()->json("Task created successfully!", 200);
        }catch(Exception $e){
            return $e;
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show($task_id)
    {
        $task = Task::where('user_id', auth()->id())
                        ->where('id', $task_id)->get();
        return response()->json($task);
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
        return response()->json('Task updated successfuly', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $task_id = $request->task_id;
        $task = Task::find($task_id);
        $task->delete();
        return response()->json('Task deleted successfuly', 200);
    }
}
