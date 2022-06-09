<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function task()
    {
        $table = Task::orderBy('id', 'desc')->with('staff')->get();
        return response()->json($table, 200);
    }
    public function singleTask($id=null)
    {
        $taskCount = Task::where('id', $id)->count();
        if($taskCount==0){
            return response()->json('record not match!' ,200);
        }

        $task = Task::where('id', $id)->first();
        return  response($task,200);
    }
    public function addTask(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
          
            if(empty($data['task'])){
                return response()->json('error_message', 'Started task is required !');
            }

            if(empty($data['staff_id'])){
                return response()->json('error_message', 'Staff field is required !');
            }            
            if(empty($data['start_date']))
            {
                $data['start_date'] = "";
            }
            if(empty($data['end_date']))
            {
                $data['end_date'] = "";
            }
            if(empty($data['description']))
            {
                $data['description'] = "";
            }

            $task = new Task;
            $task->admin_id = auth()->user()->id;
            $task->task = $data['task'];
            $task->staff_id = $data['staff_id'];
            $task->start_date = $data['start_date'];
            $task->end_date = $data['end_date'];
            $task->description = $data['description'];
            $task->status = "New";
            $task->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editTask(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();

            if(empty($data['task'])){
                return response()->json('error_message', 'Started task is required !');
            }

            if(empty($data['staff_id'])){
                return response()->json('error_message', 'Staff field is required !');
            }            
            if(empty($data['start_date']))
            {
                $data['start_date'] = "";
            }
            if(empty($data['end_date']))
            {
                $data['end_date'] = "";
            }
            if(empty($data['description']))
            {
                $data['description'] = "";
            }

            $task =  Task::find($data['id']);
            $task->admin_id = auth()->user()->id;
            $task->task = $data['task'];
            $task->staff_id = $data['staff_id'];
            $task->start_date = $data['start_date'];
            $task->end_date = $data['end_date'];
            $task->description = $data['description'];
            $task->status = $data['status'];
            $task->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteTask()
    {
      $id =Task::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);
      }
      $id->delete();
      return response()->json('success',200);
    }
}
