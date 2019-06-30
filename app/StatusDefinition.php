<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Status;

class StatusDefinition extends Model
{
    protected $table = "status_definition";
    public $guarded = ['created_at'];
    protected $connection = "client";

    public function status() 
    {
        return $this->hasMany(Status::class);
    }
}
