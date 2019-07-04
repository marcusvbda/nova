<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lead;

class Conversion extends Model
{
    public $guarded = ['created_at'];
    protected $table = "conversions";
    protected $connection = "client";

    public function leads() 
    {
        return $this->hasMany(Lead::class);
    }



}
