<?php

namespace App\Admin;


use Illuminate\Database\Eloquent\Model;
use App\Admin\Admin;

class Permission extends Model
{
    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');
            
     }
     
     public function admin() {
     
        return $this->belongsToMany(Admin::class,'users_permissions');
            
     }
}
