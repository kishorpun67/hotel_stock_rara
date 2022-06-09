<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use Session;
use App\User;
// use App\
use DB;
use App\Admin\Admin;
use App\Admin\Item;
use Carbon\Carbon;
use Auth;
use App\OrderDetail;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{

    public function addOrder()
    {
        // return session()->get('admin_id');
        $data = request()->all();
        $carts = Cart::where(['admin_id'=> session()->get('admin_id'), 'user_id'=>auth()->user()->id])->get();
        //  $carts;
        foreach($carts as $cart)
        {
            // return $cart->item_id;
            // return$getAttributeCount = Item::checkItem($cart->item_id);
            // if($getAttributeCount==0) {
            //     Item::deleteCartCount($cart->id, $session);
            //     return redirect()->back()->with('error_message','One of the Item is not avaliable. Please try agin.');
            // }
            // $stock = Item::checkStock($cart->item_id);
            // if($cart->quantity > $stock) {
            //     return redirect()->back()->with('error_message','One of the Item require stock is not avaliable. Please try agin.');
            // }
            // Item::deleteCartCount($cart->id, $cart->user_id);


            

        }
        // $checkStatus = Order::where(['user_id'=> auth()->user()->id, 'admin_id'=>session()->get('admn_id')])->latest()->first();
        // if( empty(session()->get('admin_id')) || $checkStatus->status == "Paid")
        // {
            $new  = new Order();
            $new->user_id = auth()->user()->id;
            $new->admin_id = session()->get('admin_id');
            $new->name = auth()->user()->name;
            $new->table_no = session()->get('table_no');
            $new->floor = session()->get('floor');
            $new->status = "New";
            $new->save();
            $order_id= DB::getPdo()->lastInsertId();
        // }else{
        //     $order_id = $checkStatus->id;
        // }

        foreach($carts as $cart)
        {
            $newOrder = new OrderDetail();
            $newOrder->order_id = $order_id;
            $newOrder->admin_id = $cart->admin_id;
            $newOrder->user_id = $cart->user_id;
            $newOrder->item_id = $cart->item_id;
            $newOrder->category_id = $cart->category_id;
            $newOrder->name = $cart->name;
            $newOrder->price = $cart->price;
            $newOrder->cancel = 1;
            $newOrder->quantity = $cart->quantity;
            $newOrder->image = $cart->image;
            $newOrder->message = $cart->message;
            $newOrder->status = 0;
            $newOrder->total = ($cart->quantity*$cart->price);
            $newOrder->save();
            // Item::deleteSotck($cart->item_id, $cart->quantity);
            Cart::where('id', $cart->id)->delete();
        }

         $admin = Admin::where('id', session()->get('admin_id') )->first();
         $staff = Admin::where('parent_id', session()->get('admin_id') )->get();
         $letter = collect(['title' => 'New Order by', 'name'=>auth()->user()->name]);
         $letter = json_decode(json_encode($letter), true);
         Notification::send($admin, new OrderNotification($letter));
         foreach($staff as $waiter)
        {
            $letter = collect(['title' => 'New Order by', 'name'=>auth()->user()->name]);
            $letter = json_decode(json_encode($letter), true);
            Notification::send($waiter, new OrderNotification($letter));
        }
        return redirect()->route('home');
    }
    public function payment()
    {
        
        return view('front.payment');
    }
    public function orderDetails()
    {
        $orderDetails = OrderDetail::with('order')->where(['user_id'=>auth()->user()->id, 'admin_id'=>session()->get('admin_id')])->get();
        // return $orderDetails;
        return view('front.order_detail' ,compact('orderDetails'));
    }
    public function cancelOrder($id)
    {
        $session = Session::get('code');
        $user = User::where('session', $session)->latest()->first();
        if($user->status == "Paid"){
            return redirect()->back()->with('error_message', 'Order has been already paid. You cannot cancel your order!');
        }
        if($user->status == "Delivery"){
            return redirect()->back()->with('success_message', 'Order has been already delivered.You cannot cancel your order!');
        }
        if ($user->status == "New") {
            $order = Order::where(['id'=> $id, 'session'=>$session])->first();
            $result = Order::where(['id'=> $id, 'session'=>$session])->where('status',0)->where('created_at','>=',Carbon::now()->subMinutes(60)->toDateTimeString())->delete();
            if($result)
            {
                Item::addStock($order->item_id, $order->quantity);
                $count = Order::where('session', $order->session)->count();
                if($count==0)
                {
                    User::where('id', $order->session)->delete();
                }
                return redirect()->back()->with('success_message', 'Order has been cancel successfully!');
            }else{
                return redirect()->back()->with('error_message', 'Your are canot cancel this order. Please! contact Admin');
            }

        }else{
            return redirect()->back()->with('error_message', 'Order Status has been  updated. You cannot cancel your order!');
        }

    }
}
