<?php
namespace App\Nova;
// use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
// use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
// use Laravel\Nova\Fields\BelongsTo;
// use App\Nova\Client;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use App\Nova\Metrics\EnabledTenants;
use Custom\Datecard\Datecard;

class Tenant extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function group()
    {
        return ucfirst(__('registrations'));
    }

    public static $model = 'App\Tenant';
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    
    public static function singularLabel()
    {
        return ucfirst(__('tenant'));
    }
    public static function label()
    {
        return ucfirst(__('tenants'));
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name'
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
            ID::make()->sortable(),
            Text::make(ucfirst(__("name")),'name')
                ->sortable()
                ->rules('required', 'max:255'),
            Boolean::make(ucfirst(__("enabled")),'enabled'),
            Boolean::make(ucfirst(__("principal")),'principal'),
            // BelongsTo::make(__('client'), 'client', Client::class)
            // ->display('name'),
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
        return [
            (new Datecard)->width("1/3"),
            (new EnabledTenants)->width("1/3")
        ];
    }
    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
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
        return [
            new DownloadExcel,
        ];
    }
}