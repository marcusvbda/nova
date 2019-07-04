<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lead;

class Scheduling extends Model
{
    public $guarded = ['created_at'];
    protected $table = "schedules";
    protected $connection = "client";

    public function leads() 
    {
        return $this->hasMany(Lead::class);
    }

    

}
