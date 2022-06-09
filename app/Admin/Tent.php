<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Tent extends Model
{
    public function tentType()
    {
        return $this->belongsTo('App\Admin\TentType', 'tent_type_id');
    }
}
