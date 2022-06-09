<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class SwimmingPool extends Model
{
    public function  customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
