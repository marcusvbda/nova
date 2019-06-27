<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\SuperAdminPolicy;
use App\Policies\UserPolicy;
use App\Policies\InterestPolicy;
use App\Policies\InterestTypePolicy;
use App\Policies\TenantPolicy;
use App\Policies\ClientPolicy;
use App\Client;
use App\Interest;
use App\InterestType;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => SuperAdminPolicy::class,
        Permission::class => SuperAdminPolicy::class,
        Client::class => ClientPolicy::class,
        Tenant::class => TenantPolicy::class,
        Interest::class => InterestPolicy::class,
        InterestType::class => InterestTypePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
