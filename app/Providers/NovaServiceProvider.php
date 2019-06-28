<?php

namespace App\Providers;

use Laravel\Nova\Nova;
// use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
// use Vyuldashev\NovaPermission\NovaPermissionTool;
use Spatie\BackupTool\BackupTool;
use Infinety\Filemanager\FilemanagerTool;
use Auth;
// use Vinicius\CustomCard\CustomCard;
use App\Nova\Metrics\NewLeads;
use App\Nova\Metrics\LeadsPerDay;
use App\Nova\Metrics\WinnersByLocation;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use Custom\Datecard\Datecard;

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
            new Datecard,
            (new NewLeads)->width("2/3"),
            (new LeadsPerDay)->width("2/3"),
            // (new WinnersByLocation)->width("1/3"),
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
            NovaPermissionTool::make()->canSee(function () use ($user) 
            {
                return $user->superadmin;
            }),
            BackupTool::make()->canSee(function () use ($user) 
            {
                return $user->superadmin;
            }),
            FilemanagerTool::make()->canSee(function () use ($user) 
            {
                return $user->superadmin;
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
