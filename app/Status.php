<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lead;
use App\StatusDefinition;

class Status extends Model
{
    public $guarded = ['created_at'];
    protected $table = "status";
    protected $connection = "client";

    public function definition() 
    {
        return $this->belongsTo(StatusDefinition::class);
    }

    public function leads() 
    {
        return $this->hasMany(Lead::class);
    }
}
