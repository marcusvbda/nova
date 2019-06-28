<?php
namespace App\Nova;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Dniccum\PhoneNumber\PhoneNumber;
use App\Nova\Actions\MakeLeadAWinner;
use App\Nova\Lenses\RecentWinners;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Lead extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Lead';
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name'
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
            Text::make('Name'),
            Text::make('Email'),
            Text::make(ucfirst(__("phone")),"phone"),
            Text::make(ucfirst(__("cell")),"cell"),
            Text::make(ucfirst(__("city")),"city"),
            Text::make(ucfirst(__("state")),"state"),
            // BelongsTo::make('Location','location'),
            // DateTime::make('Is Winner')->hideFromIndex(),
            // Boolean::make('Is Winner', function () {
            //     return $this->is_winner != null;
            // })->onlyOnIndex(),
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
            // new NewLeads,
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
        return [
            // new LeadByLocation,
        ];
    }
    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new RecentWinners
        ];
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
            new MakeLeadAWinner,
        ];
    }
}