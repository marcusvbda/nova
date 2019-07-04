<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;
use Spatie\Permission\Models\Role;

class UsersPerRole extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $roles = Role::with('users')->get();
        $data = [];
        foreach ($roles as $r) {
            $data[$r->name] = $r
                ->users()
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
        return __("Users Per Role");
    }

    public function uriKey()
    {
        return 'users-per-role';
    }
}
