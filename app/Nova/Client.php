<?php
namespace App\Nova;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Client extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Client';
    public static $globallySearchable = false;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static function group()
    {
        return ucfirst(__('registrations'));
    }
    public static $title = 'id';
    public static function label()
    {
        return __('Clients');
    }
    
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
            Text::make(__("Subdomain"),'subdomain')
                ->sortable()
                ->rules('required', 'max:255'),
            Boolean::make(ucfirst(__("enabled")),'enabled'),
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
            new DownloadExcel
        ];
    }
}