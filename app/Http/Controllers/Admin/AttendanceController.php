<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use Session;
use App\Admin\Admin;
use Mail;
class AttendanceController extends Controller
{
    public function attendance()
    {
        $attendance = Attendance::with('staff')->get();
        Session::flash('page', 'attendance');
        return view('admin.attendance.view_attendance', compact('attendance'));
    }

    public function addEditAttendance(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Attendance";
            $button ="Submit";
            $attendance = new Attendance;
            $attendanceData = array();
            $message = "Attendance has been added sucessfully";
            
               
        }else{
            $title = "Edit Attendance";
            $button ="Update";
            $attendanceData = Attendance::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $attendanceData= json_decode(json_encode($attendanceData),true);
            $attendance = Attendance::find($id);
            $message = "Attendance has been updated sucessfully";
        }
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
            $attendance->admin_id = auth('admin')->user()->id;
            $attendance->staff_id = $data['staff_id'];
            $attendance->in_date = $data['in_date'];
            $attendance->in_time = $data['in_time'];
            $attendance->out_date = $data['out_date'];
            $attendance->out_time = $data['out_time'];
            $attendance->save();
            Session::flash('success_message', $message);
            return redirect('admin/attendance');
        }
        Session::flash('page', 'attendance');
        $staff = Admin::where('role_id','>',2)->get();
        return view('admin.attendance.add_edit_attendance', compact('title','button','attendanceData', 'staff'));
    }

    public function viewSalary()
    {
        $attendance = Attendance::with('staff')->where('out_date', "!=",'')->where('out_time', "!=",'')->get();
        Session::flash('page', 'salary');
        return view('admin.salary.view_salary',compact('attendance'));
    }

    
    

    public function deleteAttendance($id)
    {
      $id =Attendance::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Attendance has been deleted successfully!');
    }
}
