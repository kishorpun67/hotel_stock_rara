<?php
namespace App\Traits;
use App\Admin\Role;
use App\Admin\Permission;
use App\Admin\AdminPermission;

use App\Admin\AdminRole;
trait HasPermissionTrait{

  
    public function givePermissionsTo(... $permissions) {

        $permissions = $this->getAllPermissions($permissions);
        dd($permissions);
        if($permissions === null) {
          return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
      }
    
      public function withdrawPermissionsTo( ... $permissions ) {
    
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    
      }
    
      public function refreshPermissions( ... $permissions ) {
    
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
      }
    
      public function hasPermissionTo($permission) {
    
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
      }
    
      public function hasPermissionThroughRole($permission) {
    
        foreach ($permission->roles as $role){
          if($this->roles->contains($role)) {
            return true;
          }
        }
        return false;
      }
    
      public function hasRole( ... $roles ) {
    
        foreach ($roles as $role) {
          if ($this->roles->contains('roles', $role)) {
            return true;
          }
        }
        return false;
      }
    
      public function roles() {
    
        return $this->belongsToMany(Role::class,'admin_roles');
    
      }
      public function permissions() {
    
        return $this->belongsToMany(Permission::class,'admin_permissions');
    
      }
      public function hasPermission($permission) {
              
        return (bool) AdminPermission::where(['admin_id' =>auth('admin')->user()->id, 'permission_id'=>$permission])->count();
      }
    
      protected function getAllPermissions(array $permissions) {
    
        return Permission::whereIn('permission',$permissions)->get();
        
      }
}