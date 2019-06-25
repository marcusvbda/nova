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
            // 30 => '30 Days',
            // 60 => '60 Days',
            // 365 => '365 Days',
            // 'MTD' => 'Month To Date',
            // 'QTD' => 'Quarter To Date',
            // 'YTD' => 'Year To Date',
            7 => '1 Week',
            14 => '2 Weeks',
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
