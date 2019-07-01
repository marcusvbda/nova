<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\Tag as _Tag;
class Tag extends _Tag
{
    protected $connection = "client";
}
