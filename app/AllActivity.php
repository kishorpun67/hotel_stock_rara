<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use Session;
use App\Admin\BookRoom;
use App\Order;
use App\Admin\Rafting;
use App\Admin\SwimmingPool;
// use App\Admin\Camping;
use App\Admin\RentTent;

class AllActivity extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function book_rooms()
    {
        return $this->belongsTo('App\Admin\BookRoom', 'book_room_id');
    }

    public function rafting()
    {
        return $this->belongsTo('App\Admin\Rafting', 'rafting_id');
    }

    public function swimming()
    {
        return $this->belongsTo('App\Admin\SwimmingPool', 'swimming_id');
    }

    public function camping()
    {
        return $this->belongsTo('App\Admin\RentTent', 'camping_id');
    }

}
