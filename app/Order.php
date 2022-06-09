<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    

}
