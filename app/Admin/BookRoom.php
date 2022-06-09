<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class BookRoom extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Admin\Room', 'room_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
