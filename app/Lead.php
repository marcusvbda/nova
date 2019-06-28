<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
class Lead extends Model
{
    use Actionable;
    
    public $guarded = ['created_at'];
    protected $table = "leads";
    protected $connection = "client";
}