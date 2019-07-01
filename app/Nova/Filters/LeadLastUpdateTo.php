<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Carbon\Carbon;

class LeadLastUpdateTo extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'date-filter';
    

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public $name = 'Ultima Apartir de ...';

    public function apply(Request $request, $query, $value)
    {
        $to = Carbon::parse($value);
        return $query->whereDate("updated_at","<=",$to);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $options = [];
        return $options;
    }
}
