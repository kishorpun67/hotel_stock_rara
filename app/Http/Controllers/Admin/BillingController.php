<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Session;
use App\Admin\BookRoom;
use App\Order;
use App\Admin\Rafting;
use App\Admin\SwimmingPool;
// use App\Admin\Camping;
use App\Admin\RentTent;

class BillingController extends Controller
{
    public function billing()
    {
        $customer = Customer::get();
        Session::flash('page', 'billing');
        return view('admin.billing.view_billing', compact('customer'));
    }   

    public function customerAllInvoice($id=null)
    {
        $customer = Customer::with(['sales', 'swimming_pool', 'rafting', 'camping', 'book_room'])->where('id', $id)->first();
        $sales = Order::with('ordrDetails')->where('customer_id', $id)->where('status', '!=', 'Paid')->latest()->first();
        $swimmingPool = SwimmingPool::where('customer_id', $id)->where('status', '!=', 'Paid')->latest()->first();
        $rafting = Rafting::where('customer_id', $id)->where('status', '!=', 'Paid')->latest()->first();
        $camping = RentTent::where('customer_id', $id)->where('status', '!=', 'Paid')->latest()->first();
        $bookRoom = BookRoom::with('room')->where('customer_id', $id)->where('status', '!=', 'Paid')->latest()->first();
        Session::flash('page', 'billing');
        return view('admin.billing.billing_invoice', compact('customer','sales', 'swimmingPool', 'rafting', 'camping' , 'bookRoom'));
        
    }

    public function customerBillingPrint($id=null)
    {
        Order::where('customer_id', $id)->latest()->update(['status'=>"Paid"]);
        SwimmingPool::where('customer_id', $id)->latest()->update(['status'=>"Paid"]);
        Rafting::where('customer_id', $id)->latest()->update(['status'=>"Paid"]);
        RentTent::where('customer_id', $id)->latest()->update(['status'=>"Paid"]);
        BookRoom::with('room')->where('customer_id', $id)->latest()->update(['status'=>"Paid"]);        
        $customer = Customer::with(['sales', 'swimming_pool', 'rafting', 'camping', 'book_room'])->where('id', $id)->first();
        $sales = Order::with('ordrDetails')->where('customer_id', $id)->latest()->first();
        $swimmingPool = SwimmingPool::where('customer_id', $id)->latest()->first();
        $rafting = Rafting::where('customer_id', $id)->latest()->first();
        $camping = RentTent::where('customer_id', $id)->latest()->first();
        $bookRoom = BookRoom::with('room')->where('customer_id', $id)->latest()->first();
        return view('admin.billing.bill_print', compact('customer', 'sales', 'swimmingPool', 'rafting', 'camping' , 'bookRoom'));
    }
}
