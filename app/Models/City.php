<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{



public function trip()
{
    return $this->hasMany(Trip::class);
}
}
