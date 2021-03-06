<?php

namespace App\Providers;

use App\Permission;
use App\Policies\UserPolicy;
use App\ProvincialZone;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class=>UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user){
           if($user->isSuperUser()) return true;
        });

         foreach (Permission::all() as $permission){
            Gate::define($permission->name,function ($user) use ($permission){
               return $user->hasPermission($permission);
            });
        }

         foreach (ProvincialZone::all() as $provincialZone){
             Gate::define($provincialZone->name,function ($user) use ($provincialZone){
                return $user->hasProvincialZone($provincialZone);
             });
         }
    }
}
