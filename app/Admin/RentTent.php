<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RentTent extends Model
{
    public function customer()
    {
        return $this->belongsTo("App\Customer", 'customer_id');
    }

    public function tent()
    {
        return $this->belongsTo('App\Admin\Tent', 'tent_id');
    }
}
