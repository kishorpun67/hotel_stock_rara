<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Cart;
use Session;
use Auth;
use View;
class CartController extends Controller
{
// $request->session()->put('key', $value);
    public function cart()
    {
        $carts = Cart::where(['admin_id' => session()->get('admin_id'), 'user_id'=>auth()->user()->id])->get();
        return view('front.cart', compact('carts'));
    }
    public function addCart(Request $request)
    {
        $data = $request->all();
        $count = Cart::where(['user_id'=>auth()->user()->id, 'item_id'=>$data['item_id']])->count();
        if($count==1)
        {
            return redirect()->back()->with('error_message', 'Item already exist in cart!');
        }
        if(empty($data['remark']))
        {
            $data['remark']="";
        }
        if($data['tab']==1)
        {
            $data['no_user'] = 1;
        }
        $cart = new Cart;
        $cart->admin_id =  session()->get('admin_id');
        $cart->table_no =  session()->get('table_no');
        $cart->floor =  session()->get('floor');
        $cart->item_id =  $data['item_id'];
        $cart->no_user =  $data['no_user'];
        $cart->user_id =  auth()->user()->id;
        $cart->category_id = $data['category_id'];
        $cart->name = $data['name'];
        $cart->price = $data['price'];
        $cart->message = $data['remark'];
        $cart->image = $data['image'];
        $cart->quantity = $data['quant'];
        $cart->save();
        return redirect()->back()->with('success_message','You item has been added in cart successfullly');
    }

    public function updateCart(Request $request)
    {
        $data = $request->all();
        if($data['qty']=="qtyMinus"){
            $cart =  Cart::where(['admin_id'=>session()->get('admin_id'), 'id'=>$data['cart_id']])->decrement('quantity',1);

        }elseif($data['qty']=="qtyPlus")
        {
            $cart =  Cart::where(['admin_id'=>session()->get('admin_id'), 'id'=>$data['cart_id']])->increment('quantity',1);
        }
        $carts = Cart::where(['admin_id' => session()->get('admin_id'), 'user_id'=>auth()->user()->id])->get();
        return response()->json(['view'=>(String)View::make('front.cartAjax')->with(compact('carts'))]);
    }

    public function cartDelete($id)
    {
        Cart::where('id', $id)->delete();
        return redirect()->back()->with('success_message','Item has been deleted successfully form cart!');
    }

}
