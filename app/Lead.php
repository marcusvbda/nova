<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Location;
use Laravel\Nova\Actions\Actionable;
class Lead extends Model
{
    use Actionable;
    
    public $guarded = ['created_at'];
    protected $table = "leads";
    protected $connection = "client";
    protected $casts = [
        'is_winner' => 'datetime',
    ];
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}