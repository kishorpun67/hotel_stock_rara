<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    public function roomType()
    {
        return $this->belongsTo('App\Admin\RoomType', 'room_type_id')->select('id','room_type');
    }
}
