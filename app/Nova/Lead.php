<?php
namespace App\Nova;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Marcusvbda\InputMask\InputMask;
use Marcusvbda\CustomFields\CustomFields;
use App\Nova\Actions\MakeLeadAWinner;
use App\Nova\Lenses\RecentWinners;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use App\Nova\Filters\LeadByStatus;
use App\CustomField;

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
        'name',
        'city',
        'state',
        'cell',
        'phone'
    ];
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $fields=  [
            ID::make()->sortable(),
            Text::make('Name')->sortable()->rules('required'),
            Text::make('Email')->sortable()->rules('required', 'email', 'max:255'),
            InputMask::make(ucfirst(__("phone")),"phone")
                ->mask("(##) ####-####")  
                ->hideFromIndex(),
            InputMask::make(ucfirst(__("cell")),"cell")
                ->mask("(##) ####-####,(##) #####-####")  
                ->hideFromIndex(),    
            Text::make(ucfirst(__("city")),"city")->sortable(),
            Text::make(ucfirst(__("state")),"state")->sortable()
                ->hideFromIndex(),
            BelongsTo::make('Status','status') 
                ->sortable()
                ->rules('required'),
        ];
        foreach(CustomField::get() as $customField)
        {
            $fields[]=CustomFields::make($customField->name)  
                ->field_id($customField->id)
                ->values($this->custom_values)
                ->type($customField->type)
                ->options($customField->options)
                ->hideFromIndex();
        }
        return $fields;
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
            new LeadByStatus,
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
            // new RecentWinners
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
            // new MakeLeadAWinner,
        ];
    }
}