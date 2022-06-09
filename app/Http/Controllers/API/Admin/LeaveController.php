<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Leave;
class LeaveController extends Controller
{
    public function leave()
    {
        $leave = Leave::get();
        return response()->json($leave, 200);
    }

    public function singleLeave($id=null)
    {
        $leaveCount = Leave::where('id', $id)->count();
        if($leaveCount==0){
            return response()->json('record not match!' ,200);
        }

        $leave = Leave::where('id', $id)->first();
        return  response($leave,200);
    }

    public function addLeave(Request $request)
    {

        $data=  $request->all();
        if(empty($data['date']))
        {
            $data['date'] = "";
        }
        if(empty($data['subject']))
        {
            $data['subject'] = "";
        }
        if(empty($data['days']))
        {
            $data['days'] = "";
        }
        if(empty($data['status']))
        {
            $data['status'] = "";
        }
        $leave = new Leave();
        if($file = $request->hasFile('letter')) {
             
            $file = $request->file('letter') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/images/letter' ;
            $file->move($destinationPath,$fileName);
            $leave->letter = $fileName;

         
        }

        $leave->admin_id = auth()->user()->id;
        $leave->date = $data['date'];
        $leave->subject = $data['subject'];
        $leave->days = $data['days'];
        $leave->status = "New";
        $leave->save();
        return  response('sucess',200);

    }

    public function updateLeaveStatus()
    {
        if(empty(request('status')))
        {
            return view()->json('Status field is required!');
        }
        $leave =  Leave::find(request('id'));
        $leave->status = request('status');
        $leave->save();
        return  response('sucess',200);
    }

    public function deleteLeave()
    {
        $id =Leave::find(request('id'));
        if(empty($id)){
          return response()->json('Id is not found',200);
        }
        $id->delete();
        return response()->json('success',200);
  
    }

    
}
