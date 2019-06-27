<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\SELECT;
use Laravel\Nova\Fields\TEXT;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaItemsField\Items;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class CustomField extends Resource
{
    use HasDependencies;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\CustomField';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static function singularLabel()
    {
        return ucfirst(__('custom lead field'));
    }
    public static function label()
    {
        return ucfirst(__('custom lead fields'));
    }

    public static $title = 'name';

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
            Select::make(ucfirst(__("types")),"type")->options([
                'text'      =>   ucfirst(__('text')),
                'number'    =>   ucfirst(__('number')),
                'select'    =>   ucfirst(__('select')),
                'phone'     =>   ucfirst(__('phone')),
                'checkbox'  =>   ucfirst(__('checkbox')),
                'email'     =>   ucfirst(__('email'))
            ]),
            NovaDependencyContainer::make([
                Items::make(ucfirst(__("options")),"options")
                    ->placeholder(__("Add a new item"))
                    ->createButtonValue(__("Add"))
            ])->dependsOn('type', "select"),
            
            
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
