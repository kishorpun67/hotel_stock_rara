<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Cancel extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function staff()
    {
        return $this->belongsTo('App\Admin\Admin', 'staff_id')->select('id', 'name');
    }
    public function item()
    {
        return $this->belongsTo('App\Admin\Item', 'item_id')->select('id', 'item');
    }
}
