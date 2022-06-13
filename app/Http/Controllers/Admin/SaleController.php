<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\FoodCategory;
use App\FoodMenu;
use App\Cart;
use App\Waiter;
use App\Customer;
use Image;
use Session;
use App\Order;
use App\OrderDetail;
use DB;
use App\Table;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;
use App\Admin\Admin;
use View;
use App\CustomerTable;
use Facade\Ignition\Tabs\Tab;
use App\Admin\Room;

class SaleController extends Controller
{
    public function Sale()
    {
        $sale = Order::orderBy('id', 'DESC')->get();
        Session::flash('page', 'sale');
        return view('admin.sale.view_sale', compact('sale'));
    }

    public function addEditSale(Request $request, $id=null)
    {
        // return $id;
        $foodCategories = FoodCategory::get();
        $carts = Cart::orderBy('id', 'DESC')->where('admin_id',auth('admin')->user()->id)->get();
        $foodMenus = FoodMenu::get();
        $waiter = Admin::where('role_id',6)->get();
        $customer = Customer::get();
        $table =array();
        Session::flash('page', 'sale');
        return view('admin.sale.table_room', compact('foodCategories','foodMenus','carts','waiter','table'));
    }

    public function ajaxGetItem()
    {
        $category_id = request('category_id');
        if($category_id =="all")
        {
            $foodMenus = FoodMenu::get();
        }else{
            $foodMenus = FoodMenu::where('category_id', $category_id)->get();
        }
       return view('admin.sale.ajaxItem', compact('foodMenus'));
    }

    public function ajaxGetItemType()
    {
        if( request('item_type') =="All")
        {
            $foodMenus = FoodMenu::get();
        }
        if( request('item_type') =="Kitchen")
        {
            $foodMenus = FoodMenu::where('is_kitchen','Yes')->get();
        }
        if( request('item_type') =="Bar")
        {
            $foodMenus = FoodMenu::where('is_bar', 'Yes')->get();
        }
        if( request('item_type') =="Caffe")
        {
            $foodMenus = FoodMenu::where('is_caffe', 'Yes')->get();
        }
        return view('admin.sale.ajaxItem', compact('foodMenus'));

    }

    public function ajaxFoodTable(Request $request)
    {
        $data = $request->all();
        $newcarts = new Cart;
        // $newcarts->item_id = $data['item_id'];
        $newcarts->admin_id = auth('admin')->user()->id;
        $newcarts->price = $data['price'];
        $newcarts->item = $data['name'];
        $newcarts->quantity =1;
        // $newcarts->total = $data['price'] ;
        $newcarts->is_caffe = $data['is_caffe'];
        $newcarts->is_bar = $data['is_bar'];
        $newcarts->is_kitchen = $data['is_kitchen'];
        $newcarts->save();
        $carts = Cart::where('admin_id',auth('admin')->user()->id)->get();
        $waiter = Admin::where('role_id',6)->get();
        $customer = Customer::get();
        // $table = Table::where('id',$data['table'])->first();
       return view('admin.sale.ajax_food_table',compact('carts','waiter', 'customer'));
    }
    public function updateCart(Request $request)
    {
        $data = $request->all();
        if($data['qty']=="qtyMinus"){
            $cart =  Cart::where(['admin_id'=>auth('admin')->user()->id, 'id'=>$data['cart_id']])->decrement('quantity',1);
        }elseif($data['qty']=="qtyPlus")
        {
            $cart =  Cart::where(['admin_id'=>auth('admin')->user()->id, 'id'=>$data['cart_id']])->increment('quantity',1);
        }
        $carts = Cart::orderBy('id', 'DESC')->where(['admin_id' => auth('admin')->user()->id])->get();
        $waiter = Admin::where('role_id',6)->get();
        $customer = Customer::get();
        return response()->json(['view'=>(String)View::make('admin.sale.ajax_food_table')->with(compact('carts', 'waiter', 'customer'))]);
   
    }

    public function deleteCart()
    {
        Cart::where('id', request('cart_id'))->delete();
        $carts = Cart::orderBy('id', 'DESC')->where(['admin_id' => auth('admin')->user()->id])->get();
        $waiter = Admin::where('role_id',6)->get();
        $customer = Customer::get();
        return response()->json(['view'=>(String)View::make('admin.sale.ajax_food_table')->with(compact('carts', 'waiter', 'customer'))]);
     }

    public function deleteSale($id)
    {
        $id =Order::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'sale has been deleted successfully!');
    }

    public function table($url=null)
    {
        // return $url;
        // return CustomerTable::get();
        return view('admin.sale.table',compact('url'));
    }
    public function ajaxGetRoomTable()
    {
        $table = Table::where('room_id', request('room_id'))->get();
        return view('admin.sale.ajax_table_room', compact('table'));
    }
    public function addCusomter()
    {
        $addCustomerNumber = new CustomerTable();
        $addCustomerNumber->admin_id = auth('admin')->user()->id;
        $addCustomerNumber->table_id = request('table_id');
        $addCustomerNumber->no_customer = request('no_customer');
        $addCustomerNumber->type = request('type');
        $addCustomerNumber->save();

        // get avilable seat 
        $seat_capacity = Table::where('id', request('table_id'))->first();

        $no_customer = CustomerTable::where([ 'table_id'=>request('table_id')])->sum('no_customer');
        $available_seat = $seat_capacity->seat_capacity - $no_customer;
        if($available_seat < 0){
            $count =0;
        }else{
            $count =1;
        }
        $data = CustomerTable::where(['table_id'=>request('table_id')])->get();
        return response()->json(['data'=>$data, 'table_ids'=>request('table_id'), 'available_seat'=>$available_seat , 'count'=>$count, 'no_customer'=>$no_customer], 200);
    }
    public function deleteCusomter()
    {
        CustomerTable::where('id',request('customer_id'))->delete();
        $data = CustomerTable::where([ 'table_id'=>request('table_id')])->get();
        // get avilable seat 
        $seat_capacity = Table::where('id', request('table_id'))->first();
        $no_customer = CustomerTable::where(['table_id'=>request('table_id')])->sum('no_customer');
        $available_seat = $seat_capacity->seat_capacity - $no_customer;
        return response()->json(['data'=>$data, 'table_ids'=>request('table_id'), 'available_seat'=>$available_seat, 'no_customer'=> $no_customer], 200); 
    }
    public function addTable()
    {
        request()->all();
        if(empty(request('table_id')) && empty(request('room_id'))){
            return redirect()->back();
        }
        if(!empty(request('table_id')) && !empty(request('room_id'))){
            // return "first";
            $table = Table::with('room')->where(['id'=>request('table_id'), 'room_id'=>request('room_id')])->first();
        } else if (!empty(request('room_id'))) {   
            $table = Room::where('id',request('room_id'))->first();
        } else{
            $table = Table::where('id',request('table_id'))->first();
        }
        $foodCategories = FoodCategory::get();
        $carts = Cart::orderBy('id', 'DESC')->where('admin_id', auth('admin')->user()->id)->get();
        $foodMenus = FoodMenu::with('foodCategory')->get();
        $waiter = Admin::where('role_id',6)->get();
        $customer = Customer::get();
        $order = Order::with('table', 'customer', 'room')->orderBy('id','Desc')->where('status', '!=', 'Cancel')->get();
        Session::flash('page', 'sale');
        return view('admin.sale.add_edit_sale', compact('order','foodCategories','foodMenus','carts','waiter','customer', 'table'));
    }
    
    public function placeOrder()
    {
        $data = request()->all();
        if(empty($data['waiter_id']) ){
            $data['waiter_id'] = 0;
        }
        if( empty($data['customer_id'])){
            $data['customer_id'] = 0;
        }
        if( empty($data['discount'])){
            $data['discount'] = 0;
        }
        if( empty($data['tax'])){
            $data['tax'] = 0;
        }
        $no_customer = CustomerTable::where(['admin_id'=>auth('admin')->user()->id, 'table_id'=>request('table_id')])->sum('no_customer');
        $latestOder = Order::where('customer_id', $data['customer_id'])->latest()->first();

        $carts = Cart::get();
        if(empty($latestOder->status)  || $latestOder->status == "Paid" || $latestOder->status == "Cancel"){
            $new  = new Order();
            $new->waiter_id = $data['waiter_id'];
            $new->admin_id = auth('admin')->user()->id;
            $new->customer_id = $data['customer_id'];
            $new->table_id = $data['table_id'];
            $new->room_id = $data['room_id'];
            // $new->discount = $data['discount'];
            $new->tax = $data['tax'];
            $new->total = $data['total'];
            $new->number_of_customer =$no_customer;
            $new->status = "New";
            $new->save();
            $order_id= DB::getPdo()->lastInsertId();
        }else{
            $order_id = $latestOder->id;
        }

        foreach($carts as $cart)
        {
            // return $cart->is_kitchen;
            $newOrder = new OrderDetail();
            $newOrder->order_id = $order_id;
            $newOrder->item = $cart->item;
            $newOrder->price = $cart->price;
            $newOrder->quantity = $cart->quantity;
            $newOrder->is_bar = $cart->is_bar;
            $newOrder->is_kitchen = $cart->is_kitchen;
            $newOrder->is_caffe = $cart->is_caffe;
            $newOrder->status = 'New';
            // $newOrder->message = $cart->message;
            $newOrder->total = ($cart->quantity*$cart->price);
            $newOrder->save();
            Cart::where('id', $cart->id)->delete();
            if(!empty($cart->is_caffe))
            {
                $caffe = collect(['title' => "Order :", "order_id"=>$order_id, 'body'=>"has benn modified"]);
                $caffe = json_decode(json_encode($caffe), true);
            }
            if(!empty($cart->is_kitchen))
            {
                $kitchen = collect(['title' => "Order :", "order_id"=>$order_id, 'body'=>"has benn modified"]);
                $kitchen = json_decode(json_encode($kitchen), true);
            }
            if(!empty($cart->is_bar))
            {
                $bar = collect(['title' => "Order :", "order_id"=>$order_id, 'body'=>"has benn modified"]);
                $bar = json_decode(json_encode($bar), true);
            }
        }
        $kitchen_staff = Admin::where('role_id',7)->get();
        $bar_staff = Admin::where('role_id',8)->get();
        $caffe_staff = Admin::where('role_id',9)->get();
        if(!empty($kitchen))
        {
            foreach($kitchen_staff as $kitchen_staff){
                Notification::send($kitchen_staff, new OrderNotification($kitchen));
            }
        }
        if(!empty($caffe))
        {
            foreach($caffe_staff as $caffe_staff){
                Notification::send($caffe_staff, new OrderNotification($caffe));
            }
        }
        if(!empty($bar))
        {
            foreach($bar_staff as $bar_staff){
                Notification::send($bar_staff, new OrderNotification($bar));
            }
        }
        return redirect()->back();
    }
    public function ajaxGetModifyOrder()
    {
        $orderDetails  = Order::with('ordrDetails')->where('id', request('order_id'))->first();
        // return response()->json($orderDetails);
        return view('admin.sale.ajaxOderModify', compact('orderDetails'));
    }
    public function updateOrder(Request $request)
    {
        $data = $request->all();
        if($data['qty']=="qtyMinus"){
            $cart =  OrderDetail::where([ 'id'=>$data['cart_id']])->decrement('quantity',1);
        }elseif($data['qty']=="qtyPlus")
        {
            $cart =  OrderDetail::where([ 'id'=>$data['cart_id']])->increment('quantity',1);
        }
        $orderDetails  = Order::with('ordrDetails')->where('id', request('order_id'))->first();
        return view('admin.sale.ajaxOderModify', compact('orderDetails'));
    }
    public function deleteOrderDetails(Request $request)
    {
        OrderDetail::where('id', request('cart_id'))->delete();
        $orderDetails  = Order::with('ordrDetails')->where('id', request('order_id'))->first();
        return view('admin.sale.ajaxOderModify', compact('orderDetails'));
    }
    public function ajaxOrderDetails()
    {
        $orderDetails  = Order::with('ordrDetails')->where('id', request('order_id'))->first();
        return view('admin.sale.ajax_order_details', compact('orderDetails'));
    }
    public function ajaxKotOrderDetails(){
        $orderDetails =  Order::with('kitchen', 'customer', 'waiter')->where('id', request('order_id'))->first();
        return view('admin.sale.ajax_kot', compact('orderDetails'));

    }
    public function ajaxBotOrderDetails(){
        $orderDetails =  Order::with('bar', 'customer', 'waiter')->where('id', request('order_id'))->first();
        return view('admin.sale.ajax_bot', compact('orderDetails'));

    }
    
    public function orderInnovice()
    {
        $orderDetails  = Order::with('ordrDetails')->where('id', request('order_id'))->first();
        return view('admin.sale.ajax_checkout', compact('orderDetails'));
    }
    public function orderBill(){
        $orderDetails  = Order::with('ordrDetails', 'customer')->where('id', request('order_id'))->first();
        return view('admin.sale.innovice', compact('orderDetails'));
    }
    public function cancelOrder(){
        Order::where('id' , request('order_id'))->update(['status'=>'Cancel']);
        return redirect()->back();
    
    }
    public function kitchenStatus()
    {
        $orderDetails =  Order::with('kitchen', 'customer', 'waiter')->where('id', request('order_id'))->first();
        return view('admin.sale.ajax_kitchen_status', compact('orderDetails'));

    }
    public function billPrint()
    {
        $orderbill = Order::with('ordrDetails', 'customer')->where('id', request('order_id'))->first();
        return view('admin.sale.bill_print', compact('orderbill'));
    }
    public function saleBillPring($id=null)
    {
        $orderbill = Order::with('ordrDetails', 'customer')->where('id', $id)->first();
        return view('admin.sale.bill_print', compact('orderbill'));
    }
    
   public function ajaxSearchFood(Request $request)
   {
       $data = $request->all();
       $foodMenus = FoodMenu::where('name','like', '%'.$data['searchItem'].'%')->get();
       return view('admin.sale.ajaxItem', compact('foodMenus'));
   }
}
