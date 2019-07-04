<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
use Spatie\BackupTool\BackupTool;
use Infinety\Filemanager\FilemanagerTool;
use Auth;
use App\Nova\Metrics\NewLeads;
use App\Nova\Metrics\LeadsPerDay;
use App\Nova\Metrics\LeadsPerDefinition;
use App\Nova\Metrics\EnabledTenants;
use App\Nova\Metrics\UsersPerRole;
use Custom\Datecard\Datecard;
use App\Nova\Metrics\LeadsPerStatus;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use KABBOUCHI\LogsTool\LogsTool;
use Marcusvbda\LeadOperator\LeadOperator;

class NovaServiceProvider extends NovaApplicationServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new Datecard)->width("1/3"),
            (new LeadsPerDefinition)->width("1/3"),
            (new NewLeads)->width("1/3"),
            (new LeadsPerDay)->width("2/3"),
            (new LeadsPerStatus)->width("1/3"),
            (new EnabledTenants)->width("1/3"),
            (new UsersPerRole)->width("1/3"),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        $user = Auth::user();
        return [
            NovaPermissionTool::make()
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                }),


            BackupTool::make()
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                }),

            FilemanagerTool::make()
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                }),

            LogsTool::make()
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                })
                ->canSee(function () use ($user) {
                    return $user->superadmin;
                }),

            LeadOperator::make()
                ->canSee(function () use ($user) {
                    return $user->superadmin || $user->can("Operar Leads");
                }),

        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
