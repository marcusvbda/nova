<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;
use App\Location;

class WinnersByLocation extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $locations = Location::with('leads')->take(4)->get();
        $data = [];
        foreach ($locations as $location) {
            $data[$location->name] = $location
                ->leads()
                ->whereNotNull('is_winner')
                ->count();
        }
        return $this->result($data);
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
        return 'winners-by-location';
    }
}
