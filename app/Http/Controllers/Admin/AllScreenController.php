<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\OrderDetail;
use App\Order;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;
use App\Admin\Admin;


class AllScreenController extends Controller
{
    public function kitchen()
    {
        $food =  Order::with('kitchen')->get();
        Session::flash('page', 'kitchen');
        return view('admin.allScreen.kitchen', compact('food'));
    }
    public function caffe()
    {
        $food =  Order::with('caffe')->get();
        Session::flash('page', 'caffe');
        return view('admin.allScreen.caffe', compact('food'));
    }
    public function bar()
    {
        $food =  Order::with('bar')->get();
        Session::flash('page', 'bar');
        return view('admin.allScreen.bar', compact('food'));
    }
    public function updateFoodStatus()
    {
        $data = request()->all();
        OrderDetail::where('order_id', $data['order_id'])->update([
            'status'=>$data['status']
        ]);
        $oder=Order::where('id', $data['order_id'])->first();

        $waiter = Admin::where('role_id',6)->get();
        if(!empty($data['status'])){
            foreach($waiter as $waiter){
                if(!empty($oder->table_id)){
                    $status = collect(['title' => "Tabel: $oder->table_id, Order item is", "order_id"=>$data['status'], 'body'=>""]);

                }else{
                    $status = collect(['title' => "Order item is", "order_id"=>$data['status'], 'body'=>""]);
                }
                $status = json_decode(json_encode($status), true);
                Notification::send($waiter, new OrderNotification($status));
            }
        }
        Session::flash('page', 'kitchen');
        return redirect()->back();
    }
    public function  waiterCollectFood()
    {
        $collectfood = OrderDetail::with('order')->where('status', 'Done')->where('collect',0)->get();
        Session::flash('page', 'waiter');
        return view('admin.waiter.collectfood', compact('collectfood'));
    }

    public function collectFood()
    {
        // return request('food_id');
        OrderDetail::where('id', request('food_id'))->update(['collect'=>1]);
        Session::flash('page', 'kitchen');
        return redirect()->back();

    }
}
