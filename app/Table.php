<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Admin\Room', 'room_id');
    }
}
