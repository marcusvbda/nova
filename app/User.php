<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Observers\ClientModelObserver;
use App\Scopes\ClientModelScope;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Benjacho\BelongsToManyField\HasBelongsToMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles,HasBelongsToMany;
    // SoftDeletes;
    protected $connection = "mysql";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','superadmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'superadmin' => "boolean"
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

    public function tenants() 
    {
        return $this->belongsToMany(Tenant::class);
    }

    
}
