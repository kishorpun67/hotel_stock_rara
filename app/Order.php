<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\Consumption;
use App\IngredientItem;
use App\PurchaseItem;

class Order extends Model
{
    public function ingredientCategory()
    {
        return $this->belongsTo('App\Waiter', 'waiter_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id')->select('id','customer_name');
    }
    public function Table()
    {
        return $this->belongsTo('App\Table', 'table_id');
    }
    public function kitchen()
    {
        return $this->hasMany('App\OrderDetail', 'order_id')->where('status','!=', "Done")->where('is_kitchen','Yes');
    }
    public function bar()
    {
        return $this->hasMany('App\OrderDetail', 'order_id')->where('status','!=', "Done")->where('is_bar','Yes');
    }
    public function caffe()
    {
        return $this->hasMany('App\OrderDetail', 'order_id')->where('status','!=', "Done")->where('is_caffe','Yes');
    }
    public function ordrDetails()
    {
        return $this->hasMany('App\OrderDetail', 'order_id');
    }
    public function waiter()
    {
        return $this->belongsTo('App\Admin\Admin', 'waiter_id');
    }
    public function room()
    {
        return $this->belongsTo('App\Admin\Room', 'room_id');
    }

    public static function getCustomerName($id)
    {
        $customer  = Customer::where('id', $id)->first();
        return $customer->customer_name;
        
    }

    public static function purchasePriceItem($id)
    {
        $consumption = Consumption::where('foodMenu_id', $id)->get();
        $total= 0;
        foreach($consumption as $cons){
           $purchaseItem = PurchaseItem::where('ingredient_id', $cons->ingredient_id)->latest()->first();

         $total += $purchaseItem->price * $cons->consumption_quantity;
         
        }
        return $total;

    }


    public static function getConsumptionIngredient($id)
    {
        $consumption = Consumption::with('ingredient')->where('foodMenu_id', $id)->get();
        return $consumption;

    }
    

}
