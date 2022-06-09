<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Admin\Room', 'room_id');
    }
}
