<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
class CustomerController extends Controller
{
    public function customer()
    {
        $customeres = Customer::get();
        return response()->json($customeres, 200);
    }

    public function addCustomer(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['customer_name'])){
                return redirect()->back()->with('error_message', 'Customer name is required !');
            }
            
            if(empty($data['phone']))
            {
                $data['phone'] = "";
            }

            if(empty($data['email']))
            {
                $data['email'] = "";
            }
            if(empty($data['dob']))
            {
                $data['dob'] = "";
            }
            if(empty($data['date_of_anniversary']))
            {
                $data['date_of_anniversary'] = "";
            }
            if(empty($data['address']))
            {
                $data['address'] = "";
            }
            if(empty($data['pan_no']))
            {
                $data['pan_no'] = "";
            }
       
            $customer = new Customer;
            $customer->admin_id = auth()->user()->id;
            $customer->customer_name = $data['customer_name'];
            $customer->phone = $data['phone'];
            $customer->email = $data['email'];
            $customer->dob = $data['dob'];
            $customer->date_of_aniversary = $data['date_of_aniversary'];
            $customer->address = $data['address'];
            $customer->gst_number = $data['pan_no'];
            $customer->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editCustomer(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['customer_name'])){
                return redirect()->back()->with('error_message', 'Customer name is required !');
            }
            
            if(empty($data['phone']))
            {
                $data['phone'] = "";
            }

            if(empty($data['email']))
            {
                $data['email'] = "";
            }
            if(empty($data['dob']))
            {
                $data['dob'] = "";
            }
            if(empty($data['date_of_anniversary']))
            {
                $data['date_of_anniversary'] = "";
            }
            if(empty($data['address']))
            {
                $data['address'] = "";
            }
            if(empty($data['pan_no']))
            {
                $data['pan_no'] = "";
            }
       
            $customer =  Customer::find($data['id']);
            $customer->admin_id = auth()->user()->id;
            $customer->customer_name = $data['customer_name'];
            $customer->phone = $data['phone'];
            $customer->email = $data['email'];
            $customer->dob = $data['dob'];
            $customer->date_of_aniversary = $data['date_of_aniversary'];
            $customer->address = $data['address'];
            $customer->gst_number = $data['pan_no'];
            $customer->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deleteCustomer()
    {
      $id =Customer::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);
      }
      $id->delete();
      return response()->json('success',200);


    }
}
