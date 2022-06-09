<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Payment;
use Session;

class PaymentController extends Controller
{
    public function payment()
    {
        $payment = Payment::get();
        Session::flash('page', 'payment');
        return view('admin.payment.payment', compact('payment'));
    }

    public function add(Request $request)
    {
        $data = $request->all();
        if(empty($data['payment']))
        {
            return redirect()->back()->with('error_message', 'Staff field is required');
        }
        $payment = new payment;
        $payment->admin_id = auth()->user()->id;
        $payment->name = $data['name'];
        $payment->description = $data['description'];
        $payment->save();
        return redirect()->back()->with('success_message', 'Staff has added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $payment = Payment::find($id);
        $payment->admin_id = auth()->user()->id;
        $payment->name = $data['name'];
        $payment->description = $data['description'];
        $payment->save();
        return redirect()->back()->with('success_message', 'Staff has updated successfully!');
    }

    public function delete($id)
    {
        Payment::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Payment has been deleted successfully');
    }
}
