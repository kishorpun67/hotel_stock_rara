<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function paymentMethod()
    {
        $paymentMethod = PaymentMethod::get();
        Session::flash('page', 'paymentMethod');
        return view('admin.paymentMethod.view_paymentMethod', compact('paymentMethod'));
    }

    public function addEditpaymentMethod(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add paymentMethod";
            $button ="Submit";
            $paymentMethod = new PaymentMethod;
            $paymentMethoddata = array();
            $message = "paymentMethod has been added sucessfully";
        }else{
            $title = "Edit paymentMethod";
            $button ="Update";
            $paymentMethoddata = PaymentMethod::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $paymentMethoddata= json_decode(json_encode($paymentMethoddata),true);
            $paymentMethod = paymentMethod::find($id);
            $message = "paymentMethod has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['name'])){
                return redirect()->back()->with('error_message', 'Payment Method name is required !');
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
            $paymentMethod->admin_id = auth('admin')->user()->id;
            $paymentMethod->name = $data['name'];
            $paymentMethod->description = $data['description'];
            $paymentMethod->save();
            Session::flash('success_message', $message);
            return redirect('admin/paymentMethod');
        }
        Session::flash('page', 'paymentMethod');
        return view('admin.paymentMethod.add_edit_paymentMethod', compact('title','button','paymentMethoddata'));
    }

    public function deletepaymentMethod($id)
    {
      $id =PaymentMethod::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'paymentMethod has been deleted successfully!');
    }
}
