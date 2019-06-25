<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Http\Requests\LensRequest;
use App\Nova\Filters\LeadByLocation;

class RecentWinners extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select([
                'leads.id',
                'leads.name',
                'leads.is_winner',
                'leads.created_at',
                'locations.name as location_name',
            ])
              ->whereNotNull('leads.is_winner')
              ->where('leads.is_winner', '>=', now()->subWeek())
              ->join('locations', 'leads.location_id', '=', 'locations.id')
              ->orderBy('leads.is_winner', 'desc')
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),
            Text::make('name'),
            DateTime::make('Is Winner')
                ->format('MMM DD, YYYY'),
            Number::make('Days to win', function () {
                return $this->is_winner->diffInDays($this->created_at);
            }),
            Text::make('Location', 'location_name'),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new LeadByLocation,
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'recent-winners';
    }
}
