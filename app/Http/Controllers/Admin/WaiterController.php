<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Waiter;
use Session;
class WaiterController extends Controller
{
    public function Waiter()
    {
        $waiter = Waiter::get();
        Session::flash('page', 'waiter');
        return view('admin.waiter.view_waiter', compact('waiter'));
    }

    public function addEditWaiter(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Waiter";
            $button ="Submit";
            $waiter = new Waiter;
            $waiterdata = array();
            $message = "Waiter has been added sucessfully";
        }else{
            $title = "Edit Waiter";
            $button ="Update";
            $waiterdata = Waiter::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $waiterdata= json_decode(json_encode($waiterdata),true);
            $waiter = Waiter::find($id);
            $message = "Waiter has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['name'])){
                return redirect()->back()->with('error_message', 'waiter name is required !');
            }
            
            if(empty($data['address']))
            {
                $data['address'] = "";
            }
            if(empty($data['email']))
            {
                $data['email'] = "";
            }
            if(empty($data['number']))
            {
                $data['number'] = "";
            }

            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $waiter->admin_id = auth('admin')->user()->id;
            $waiter->name = $data['name'];
            $waiter->address = $data['address'];
            $waiter->email = $data['email'];
            $waiter->number = $data['number'];
            $waiter->save();
            Session::flash('success_message', $message);
            return redirect('admin/waiter');
        }
        Session::flash('page', 'waiter');
        return view('admin.waiter.add_edit_waiter', compact('title','button','waiterdata'));
    }

    public function deleteWaiter($id)
    {
      $id =Waiter::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'waiter has been deleted successfully!');
    }
}
