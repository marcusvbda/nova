<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;
use App\Tenant;

class EnabledTenants extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $data[ucfirst(__("enabled"))] = Tenant::where("enabled",true)->count();
        $data[ucfirst(__("disabled"))] = Tenant::where("enabled",false)->count();
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
        return __("Enabled Tenants");
    }

    public function uriKey()
    {
        return 'enabled-tenants';
    }
}
