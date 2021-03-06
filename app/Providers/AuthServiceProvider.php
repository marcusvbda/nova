<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\SuperAdminPolicy;
use App\Policies\UserPolicy;
use App\Policies\CustomFieldPolicy;
use App\Policies\TenantPolicy;
use App\Policies\ClientPolicy;
use App\Client;
use App\CustomField;
use App\User;
use App\Status;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Policies\StatusPolicy;
use App\StatusDefinition;

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
        CustomField::class => CustomFieldPolicy::class,
        Status::class => StatusPolicy::class,
        StatusDefinition::class => SuperAdminPolicy::class,
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
