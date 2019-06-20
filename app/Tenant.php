<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    public $guarded = ['created_at'];
    protected $table = "tenants";
    protected $connection = "client";

    protected $casts = [
        "enabled"  =>  "boolean"
    ];
}
