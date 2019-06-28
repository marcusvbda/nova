<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;
use App\Status;

class LeadsPerStatus extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $status = Status::with('leads')->take(4)->get();
        $data = [];
        foreach ($status as $s) {
            $data[$s->name] = $s
                ->leads()
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

    public function name()
    {
        return __("Leads Per Status");
    }

    public function uriKey()
    {
        return 'leads-per-status';
    }
}
