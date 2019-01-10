<?php

namespace App;

use function compact;
use Illuminate\Database\Eloquent\Model;
use function route;
use function var_dump;

class Sensor extends Model
{
    protected $fillable = ['min_value', 'max_value', 'name'];
}
