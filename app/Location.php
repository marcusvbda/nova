<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Lead;
class Location extends Model
{
    public $guarded = ['created_at'];
    protected $table = "locations";
    protected $connection = "client";
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}