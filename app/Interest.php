<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\InterestType;

class Interest extends Model
{
    public $guarded = ['created_at'];
    protected $table = "interests";
    protected $connection = "client";

    public function InterestType() 
    {
        return $this->belongsTo(InterestType::class);
    }
 
}
