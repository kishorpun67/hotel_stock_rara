<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function staff()
    {
        return $this->belongsTo('App\Admin\Admin', 'staff_id');
    }
}
