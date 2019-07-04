<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;
use App\Lead;

class NewLeads extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */

    public function name()
    {
        return __("New Leads");
    }

    public function calculate(Request $request)
    {
        return $this->count($request, Lead::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            7 => '1 '.ucfirst(__('week')),
            14 => '2 '.ucfirst(__('weeks')),
            21 => '3 '.ucfirst(__('weeks')),
            28 => '4 '.ucfirst(__('weeks')),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'new-leads';
    }
}
