<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Session;
use Carbon\Carbon;
use App\Order;
class CustomerController extends Controller
{
    public function customer()
    {
        $customer = Customer::get();
        Session::flash('page', 'customer');
        return view('admin.customer.view_customer', compact('customer'));
    }

    public function addEditCustomer(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Customer";
            $button ="Submit";
            $customer = new Customer;
            $customerdata = array();
            $message = "customer has been added sucessfully";
        }else{
            $title = "Edit Customer";
            $button ="Update";
            $customerdata = Customer::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $customerdata= json_decode(json_encode($customerdata),true);
            $customer = Customer::find($id);
            $message = "customer has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
        //dd($data);
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
            if(empty($data['gst_number']))
            {
                $data['gst_number'] = "";
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
            $customer->admin_id = auth('admin')->user()->id;
            $customer->customer_name = $data['customer_name'];
            $customer->phone = $data['phone'];
            $customer->email = $data['email'];
            $customer->dob = $data['dob'];
            $customer->date_of_aniversary = $data['date_of_aniversary'];
            $customer->address = $data['address'];
            $customer->gst_number = $data['gst_number'];
            $customer->description = $data['description'];
            $customer->save();
            Session::flash('success_message', $message);
            return redirect()->back();
        }
        Session::flash('page', 'customer');
        return view('admin.customer.add_edit_customer', compact('title','button','customerdata'));
    }

    public function viewCustomerDeuReceives()
    {
        $customerDueOrder = Order::with('customer')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->where('due', "!=", "")->get();
        return view('admin.customerDeuReceives.view_customerDeuReceives',compact('customerDueOrder'));
    }

    public function customerReport()
    {
        $customer = Customer::get();
        return view('admin.customer.customer_report',compact('customer'));
    }

    public function deleteCustomer($id)
    {
      $id =Customer::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Customer has been deleted successfully!');
    }
}
