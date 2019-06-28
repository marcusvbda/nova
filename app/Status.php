<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $guarded = ['created_at'];
    protected $table = "status";
    protected $connection = "client";
}
