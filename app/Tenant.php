<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ClientModelObserver;
use App\Scopes\ClientModelScope;

class Tenant extends Model
{
    public $guarded = ['created_at'];
    protected $table = "tenants";

    protected $casts = [
        "enabled"  =>  "boolean"
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(new ClientModelObserver());
        static::addGlobalScope(new ClientModelScope());
    }

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }
}
