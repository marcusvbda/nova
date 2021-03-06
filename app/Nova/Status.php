<?php

namespace App\Nova;

// use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
// use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
// use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\StatusDefinition;
use App\Nova\Metrics\LeadsPerStatus;
use App\Nova\Metrics\LeadsPerDefinition;
use Custom\Datecard\Datecard;
use Laravel\Nova\Fields\ID;
use Timothyasp\Color\Color;


class Status extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $group = 'Leads'; 
    public static function singularLabel()
    {
        return ucfirst(__('status'));
    }
    public static function label()
    {
        return ucfirst(__('status'));
    }

    public static $model = 'App\Status';

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
        'name',
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
            Text::make(ucfirst(__("name")),"name"),
            BelongsTo::make(ucfirst(__("definition")),"definition",StatusDefinition::class) 
                ->sortable()
                ->rules('required'),
            Color::make(ucfirst(__("color")),'color')->slider()
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
            (new LeadsPerDefinition)->width("1/3"),
            (new LeadsPerStatus)->width("1/3"),
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
        return [];
    }
}
