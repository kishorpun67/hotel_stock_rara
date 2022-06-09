<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function sales()
    {
        return $this->hasMany('App\Order', 'customer_id')->with('ordrDetails')->latest();
    }
   
    public function swimming_pool()
    {
        return $this->hasMany('App\Admin\SwimmingPool', 'customer_id');
    }   
     public function rafting()
    {
        return $this->hasMany('App\Admin\Rafting', 'customer_id');
    }
    public function camping()
    {
        return $this->hasMany('App\Admin\RentTent', 'customer_id');
    }
    public function book_room()
    {
        return $this->hasMany('App\Admin\BookRoom', 'customer_id');
    }
}
