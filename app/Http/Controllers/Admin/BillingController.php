<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Session;
use App\Admin\BookRoom;
use App\Admin\BookSwimmingPool;
use App\Order;
use App\Admin\Rafting;
use App\Admin\SwimmingPool;
// use App\Admin\Camping;
use App\Admin\RentTent;
use App\AllActivity;
use App\PaymentMethod;

use function GuzzleHttp\Promise\all;

class BillingController extends Controller
{
    public function billing()
    {
        $customer = AllActivity::orderBy('id', 'desc')->with('customer', 'order','book_rooms','rafting', 'swimming', 'camping')->get();
        // return $customer;
        Session::flash('page', 'billing');
        return view('admin.billing.view_billing', compact('customer'));
    }   
    public function billingCheckout($id=null)
    {
       $activity = AllActivity::find($id);
        // $id = $activity->customer_id;
        // return $activity;
        $paymentMethod = PaymentMethod::get();
        $customer = Customer::where('id', $activity->customer_id)->first();
        $sales = Order::with('ordrDetails')->where(['id' => $activity->order_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $swimmingPool = SwimmingPool::where(['id' => $activity->swimming_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $rafting = Rafting::where(['id' => $activity->rafting_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $camping = RentTent::where(['id' => $activity->camping_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $bookRoom = BookRoom::with('room')->where(['id' => $activity->book_room_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        Session::flash('page', 'billing');
        return view('admin.billing.billing_checkout', compact('paymentMethod','activity','customer', 'sales', 'swimmingPool', 'rafting', 'camping' , 'bookRoom'));
        
    }
    public function customerAllInvoice($id=null)
    {
        $data = request()->all();
        if(empty($data['service_charge']))
        {
            $data['service_charge'] = "";
        }if(empty($data['subtotal']))
        {
            $data['subtotal'] = "";
        }if(empty($data['discount']))
        {
            $data['discount'] = "";
        }
        if(empty($data['paid']))
        {
            $data['paid'] = "";
        }
        if(empty($data['vat_no']))
        {
            $data['vat_no'] = "";
        }
        if(empty($data['company_name']))
        {
            $data['company_name'] = "";
        }
       
       
       
        $updateActivity = AllActivity::find($id);
        Order::where('id', $updateActivity->order_id)->update(['status' => $data['status']]);
        SwimmingPool::where('id', $updateActivity->swimming_id)->update(['status' => $data['status']]);
        BookRoom::where('id', $updateActivity->book_room_id)->update(['status' => $data['status']]);
        RentTent::where('id', $updateActivity->camping_id)->update(['status' => $data['status']]);
        Rafting::where('id', $updateActivity->rafting_id)->update(['status' => $data['status']]);
        $updateActivity->service_charge = $data['service_charge'];
        $updateActivity->discount = $data['discount'];
        $updateActivity->tax = $data['tax'];
        $updateActivity->vat = $data['vat'];
        $updateActivity->total = $data['total'];
        $updateActivity->sub_total = $data['subtotal'];
        $updateActivity->paid = $data['paid'];
        $updateActivity->vat_no = $data['vat_no'];
        $updateActivity->company_name = $data['company_name'];
        $updateActivity->payment_id = $data['payment_id'];
        $updateActivity->status = $data['status'];
        $updateActivity->save();
        $activity = AllActivity::find($id);
        // $id = $activity->customer_id;
        // return $activity;
        $customer = Customer::where('id', $activity->customer_id)->first();
        $sales = Order::with('ordrDetails')->where(['id' => $activity->order_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $swimmingPool = SwimmingPool::where(['id' => $activity->swimming_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $rafting = Rafting::where(['id' => $activity->rafting_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $camping = RentTent::where(['id' => $activity->camping_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $bookRoom = BookRoom::with('room')->where(['id' => $activity->book_room_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        Session::flash('page', 'billing');
        return view('admin.billing.billing_invoice', compact('activity','customer','sales', 'swimmingPool', 'rafting', 'camping' , 'bookRoom'));
        
    }

    public function customerBillingPrint($id=null)
    {
        $activity = AllActivity::find($id);
        // $id = $activity->customer_id;
        // return $activity;
        $customer = Customer::where('id', $activity->customer_id)->first();
        $sales = Order::with('ordrDetails')->where(['id' => $activity->order_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $swimmingPool = SwimmingPool::where(['id' => $activity->swimming_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $rafting = Rafting::where(['id' => $activity->rafting_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $camping = RentTent::where(['id' => $activity->camping_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        $bookRoom = BookRoom::with('room')->where(['id' => $activity->book_room_id, 'customer_id'=> $activity->customer_id])->latest()->first();
        Session::flash('page', 'billing');
        return view('admin.billing.bill_print', compact('activity','customer', 'sales', 'swimmingPool', 'rafting', 'camping' , 'bookRoom'));
    }

    public function deleteBilling($id)
    {
        AllActivity::where('id',$id)->delete();
        return redirect()->back()->with('success_message', 'Billing deleted successfully');
    }
}
