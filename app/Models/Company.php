<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    public function ratings()
    {
return $this->morphMany(Rating::class,'rateable');


    }

public function usershowfavorite()

{
return $this->belongsToMany(User::class,'favorite_companies');


}



public function trip()
{
    return $this->hasMany(Trip::class);
}


public function driver()
{
    return $this->hasMany(Driver::class);
}


}
