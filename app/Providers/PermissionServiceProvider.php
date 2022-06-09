<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use App\Admin\Permission;
class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            Permission::get()->map(function($permission){
                Gate::define($permission, function($user) use($permission){
                    return $user->hasPermissionTo($permission);
                });
            });
        }catch(\Exception $e){
            report($e);
            return false;
        }

        // create blade directive 
        Blade::directive('role',function($role){
            return "<?php if(auth('admin')->check() && auth('admin')->user()->hasRole({$role})) { ?>";
        });

        Blade::directive('endrole',function($role){
            return "<?php } ?>";
        });
    }
}
