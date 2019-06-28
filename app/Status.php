<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lead;

class Status extends Model
{
    public $guarded = ['created_at'];
    protected $table = "status";
    protected $connection = "client";

    public function leads() 
    {
        return $this->hasMany(Lead::class);
    }
}
