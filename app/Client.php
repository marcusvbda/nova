<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $guarded = ['created_at'];
    protected $table = "clients";

    protected $casts = [
        "enabled"  =>  "boolean"
    ];
}
