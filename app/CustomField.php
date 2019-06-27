<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class CustomField extends Model
{
    public $guarded = ['created_at'];
    protected $table = "custom_fields";
    protected $connection = "client";
    protected $casts = [
        "options" => "array"
    ];
}
