<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use Session;
use App\Admin\Admin;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskNotification;

class TaskController extends Controller
{
    public function viewTask()
    {
        $task = Task::get();
        Session::flash('page', 'admin_task_view');
        return view('admin.task.admin_task_view', compact('task'));
    }


    public function Task()
    {
        $task = Task::get();
        Session::flash('page', 'task');
        return view('admin.task.view_task', compact('task'));
    }

    
    public function addEditTask(Request $request, $id=null)
    {

        if($id=="") {
            $title = "Add task";
            $button ="Submit";
            $task = new Task;
            $taskdata = array();
            $message = "Task has been added sucessfully";
        }else{
            $title = "Edit Task";
            $button ="Update";
            $taskdata = Task::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $taskdata= json_decode(json_encode($taskdata),true);
            $task = Task::find($id);
            $message = "Task has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            if($id==null){
                 $email = Admin::select('email')->where('id', $data['staff_id'])->first();
                 $email = $email->email;
                // return $email;
                // $taskNotification = collect(['title' => "New ", "order_id"=>'task ', 'body'=>"has benn asign"]);
                // $taskNotification = json_decode(json_encode($taskNotification), true);
                // Notification::send($email, new TaskNotification($taskNotification));

            }
        // dd($data);
            if(empty($data['task'])){
                return redirect()->back()->with('error_message', 'Started task is required !');
                // Notification::send($kitchen_staff, new OrderNotification($kitchen));

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


            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $task->admin_id = auth('admin')->user()->id;

            $task->task = $data['task'];
            $task->start_date = $data['start_date'];
            $task->end_date = $data['end_date'];
            $task->description = $data['description'];
            $task->status = "New";
            $task->save();
            Session::flash('success_message', $message);
            return redirect()->route('admin.view.task');
        }
        $staff = Admin::where('role_id','>',2)->get();
        Session::flash('page', 'admin_task_view');
        return view('admin.task.add_edit_task ', compact('title','button','taskdata','staff'));
    }
    public function updateTask(Request $request, $id=null)
    {
       
        $title = "Edit Task";
        $button ="Update";
        $taskdata = Task::where('id',$id)->first();
        $taskdata= json_decode(json_encode($taskdata),true);
        $task = Task::find($id);
        $message = "Task has been updated sucessfully";
        if($request->isMethod('post')) {
            $data = $request->all();
            // $taskNotification = collect(['title' => "Task is ", "order_id"=>$data['status'], 'body'=>""]);
            // $taskNotification = json_decode(json_encode($taskNotification), true);
            // Notification::send('addmin@admin.com', new TaskNotification($taskNotification));
            if(empty($data['status']))
            {
                $data['status'] = "";
            }
            $task->status = $data['status'];
            $task->save();
            Session::flash('success_message', $message);
            return redirect('admin/task');
        }
        Session::flash('page', 'task');
        return view('admin.task.update_task ', compact('title','button','taskdata'));
    }

    public function deleteTask($id)
    {
      $id =Task::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Task has been deleted successfully!');
    }
}
