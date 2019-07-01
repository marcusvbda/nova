<?php
namespace App\Nova;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Marcusvbda\InputMask\InputMask;
use Marcusvbda\CustomFields\CustomFields;
use App\Nova\Actions\LeadTransfer;
// use App\Nova\Lenses\RecentWinners;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use App\Nova\Filters\LeadByStatus;
use App\Nova\Filters\LeadLastUpdateFrom;
use App\Nova\Filters\LeadLastUpdateTo;
use Carbon\Carbon;
use App\CustomField;
use Spatie\TagsField\Tags;
use Auth;

class Lead extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $group = 'Leads'; 
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
            Text::make(ucfirst(__("name")),"name")->sortable()->rules('required'),
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
            Tags::make('Tags'),
            Text::make(__("Last Update"), function () {
                return Carbon::parse($this->updated_at)->diffForHumans();
            })
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
            new LeadLastUpdateFrom,
            new LeadLastUpdateTo,
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
        $actions = [
            new DownloadExcel,
        ];
        $user = Auth::user();
        if($user->can("Transferir Leads")||$user->tenants->count()>1)
        {
            $actions[] = new LeadTransfer;
        }
        return $actions;
    }
}