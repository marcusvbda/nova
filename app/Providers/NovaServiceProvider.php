<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use Spatie\BackupTool\BackupTool;
use Infinety\Filemanager\FilemanagerTool;
use Auth;
use PhpJunior\NovaLogViewer\Tool as LogViewer;
// use Vinicius\CustomCard\CustomCard;

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
            new Help,
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
            LogViewer::make()->canSee(function () use ($user) 
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
