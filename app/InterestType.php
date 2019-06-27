<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Interest;

class InterestType extends Model
{
    public $guarded = ['created_at'];
    protected $table = "interest_types";
    protected $connection = "client";

    public function interests() 
    {
        return $this->hasMany(Interest::class);
    }
 
}
