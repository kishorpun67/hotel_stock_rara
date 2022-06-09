<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PaymentMethod;
class PaymentMethodController extends Controller
{
    public function payment()
    {
        $payments = PaymentMethod::get();
        return response()->json($payments, 200);
    }
    public function singlePayment($id=null)
    {
        $paymentCount = PaymentMethod::where('id', $id)->count();
        if($paymentCount==0){
            return response()->json('record not match!' ,200);
        }

        $payment = PaymentMethod::where('id', $id)->first();
        return  response($payment,200);
    }

    public function addPayment(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['name'])){
                return response()->json('Payment name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $paymentMethod = new PaymentMethod;
            $paymentMethod->admin_id = auth()->user()->id;
            $paymentMethod->name = $data['name'];
            $paymentMethod->description = $data['description'];
            $paymentMethod->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }
    public function editPayment(Request $request)
    {
        
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            if(empty($data['name'])){
                return response()->json('Payment name is required !', 200);
            }
            
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
       
            $paymentMethod =  PaymentMethod::find($data['id']);
            $paymentMethod->admin_id = auth()->user()->id;
            $paymentMethod->name = $data['name'];
            $paymentMethod->description = $data['description'];
            $paymentMethod->save();
            return  response('sucess',200);
            // Session::flash('success_message', $message);
        }
    }

    public function deletePayment()
    {
      $id =paymentMethod::find(request('id'));
      if(empty($id)){
        return response()->json('Id is not found',200);

      }
      $id->delete();
      return response()->json('success',200);

    }
}
