<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
// use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\BelongsToMany;
use Vyuldashev\NovaPermission\Role;
// use Vyuldashev\NovaPermission\Permission;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\CheckBox;
use App\Nova\Filters\UserRole;
use R64\NovaImageCropper\ImageCropper;
use Davidpiesse\NovaToggle\Toggle;
use Auth;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    
    public static $model = 'App\\User';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Usuários';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];



    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // ID::make()->sortable(),
            ImageCropper::make('Imagem','photo')->avatar(),
            // Image::make('Image','photo')
            //     ->disableDownload(),

            Text::make('Nome','name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email','email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            
            Toggle::make(__("Super Admin"),"superadmin")
            ->canSee(function ($request) {
                return Auth::user()->superadmin;
             }),

            Password::make(__("Password"),'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

               
            Password::make(__("Confirm Password"), 'password_confirmation')
               ->onlyOnForms()
               ->creationRules('required', 'required_with:password', 'string', 'min:8')
               ->updateRules('nullable', 'required_with:password', 'string', 'min:8')
               ->fillUsing(function() {}),

            BelongsToMany::make('Roles', 'roles', Role::class),
        ];
    }

    
    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [new UserRole()];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
