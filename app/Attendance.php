<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function admin()
    {
        return $this->belongsTo('App\Admin\Admin', 'admin_id');
    }
    public function staff()
    {
        return $this->belongsTo('App\Admin\Admin', 'staff_id')->select('id','name');
    }
}
