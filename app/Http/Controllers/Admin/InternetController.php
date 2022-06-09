<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Internet;
use Session;

class InternetController extends Controller
{
    public function internet()
    {
        $internet = Internet::get();
        Session::flash('page', 'internet');
        return view('admin.internet.view_internet', compact('internet'));
    }

    public function addEditInternet(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Internet";
            $button ="Submit";
            $internet = new Internet;
            $internetdata = array();
            $message = "Internet has been added sucessfully";
        }else{
            $title = "Edit Internet";
            $button ="Update";
            $internetdata = Internet::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $internetdata= json_decode(json_encode($internetdata),true);
            $internet = Internet::find($id);
            $message = "Internet has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['internet_uses'])){
                return redirect()->back()->with('error_message', 'internet Name is required !');
            }

            if(empty($data['internet_mbps']))
            {
                $data['internet_mbps'] = "";
            }
            if(empty($data['internet_month']))
            {
                $data['internet_month'] = "";
            }
            if(empty($data['start_date']))
            {
                $data['start_date'] = "";
            }
            if(empty($data['end_date']))
            {
                $data['end_date'] = "";
            }
            if(empty($data['internet_total']))
            {
                $data['internet_total'] = "";
            }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $internet->admin_id = auth('admin')->user()->id;
            $internet->internet_uses = $data['internet_uses'];
            $internet->internet_mbps = $data['internet_mbps'];
            $internet->internet_month = $data['internet_month'];
            $internet->payment_type = $data['payment_type'];
            $internet->start_date = $data['start_date'];
            $internet->end_date = $data['end_date'];
            $internet->internet_total = $data['internet_total'];
            $internet->save();
            Session::flash('success_message', $message);
            return redirect('admin/internet');
        }
        Session::flash('page', 'internet');
        return view('admin.internet.add_edit_internet', compact('title','button','internetdata'));
    }

    public function internetReport()
    {
        $internet = Internet::get();
        Session::flash('page', 'salary');
        return view('admin.report.internet_report',compact('internet'));
    }

    public function deleteInternet($id)
    {
      $id =Internet::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Internet has been deleted successfully!');
    }
}
