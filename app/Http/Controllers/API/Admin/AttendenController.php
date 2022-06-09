<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
class AttendenController extends Controller
{
    public function attendance()
    {
        $attendence = Attendance::with('staff')->get();
        return response()->json($attendence, 200);
    }
    public function singleAttendance($id=null)
    {
        $attendaceCount = Attendance::with('staff')->where('id', $id)->count();
        if($attendaceCount==0){
            return response()->json('record not match!' ,200);
        }
        $attendance = Attendance::with('staff')->where('id', $id)->first();
        return  response($attendance,200);
    }
    public function addAttendance(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();

            if(empty($data['in_date']))
            {
                $data['in_date'] = "";
            }

            if(empty($data['in_time']))
            {
                $data['in_time'] = "";
            }
            if(empty($data['out_date']))
            {
                $data['out_date'] = "";
            }
            if(empty($data['out_time']))
            {
                $data['out_time'] = "";
            }
            if(empty($data['staff_id']))
            {
                $data['staff_id'] = "";
            }
            $attendance = new Attendance;
            $attendance->admin_id = auth()->user()->id;
            $attendance->staff_id= $data['staff_id'];
            $attendance->in_date = $data['in_date'];
            $attendance->in_time = $data['in_time'];
            $attendance->out_date = $data['out_date'];
            $attendance->out_time = $data['out_time'];
            //$attendance->work_hour = $data['work_hour'];
            // $attendance->salary = $data['salary'];
            $attendance->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editAttendance(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();

            if(empty($data['in_date']))
            {
                $data['in_date'] = "";
            }

            if(empty($data['in_time']))
            {
                $data['in_time'] = "";
            }
            if(empty($data['out_date']))
            {
                $data['out_date'] = "";
            }
            if(empty($data['out_time']))
            {
                $data['out_time'] = "";
            }

           $attendance =  Attendance::find($data['id']);
           
            $attendance->admin_id = auth()->user()->id;
          
            if(!empty($data['staff_id']))
            {
                $attendance->staff_id = $data['staff_id'];
            }
            $attendance->out_date = $data['out_date'];
            $attendance->out_time = $data['out_time'];
            //$attendance->work_hour = $data['work_hour'];
            // $attendance->salary = $data['salary'];
            $attendance->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteAttendance()
    {
      $id =Attendance::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);
      }
      $id->delete();
      return response()->json('success',200);
    }
}
