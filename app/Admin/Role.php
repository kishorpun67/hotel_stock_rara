<?php

namespace App\Admin;
use App\Admin\Admin;
use App\Admin\Permission;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions() {
        return $this->belongsToMany(Permission::class,'roles_permissions');
     }
     
     public function admin() {
     
        return $this->belongsToMany(Admin::class,'users_roles');
            
     }
}
