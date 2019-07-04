<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use App\Observers\TenantModelObserver;
use App\Observers\CustomFieldObserver;
use App\Scopes\TenantModelScope;
use App\Status;
use App\Traits\HasTags;
use App\Conversion;

class Lead extends Model
{
    use Actionable,HasTags;
    
    public $guarded = ['created_at'];
    protected $table = "leads";
    protected $connection = "client";
    protected $casts = ["custom_values"=>"array"];
    protected static function boot()
    {
        parent::boot();
        static::observe(new CustomFieldObserver());
        static::observe(new TenantModelObserver());
        static::addGlobalScope(new TenantModelScope());
    }
    
    public function status() 
    {
        return $this->belongsTo(Status::class);
    }

    public function conversions() 
    {
        return $this->hasMany(Conversion::class);
    }

    public function schedules() 
    {
        return $this->hasMany(Scheduling::class);
    }



    
}