<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
use HasFactory;

    public function ratings()
    {
return $this->morphMany(Rating::class,'rateable');


    }

    public function userfavorite()

{
return $this->belongsToMany(User::class,'favorite_drivers');


}



public function trip()
{

return $this->hasMany(Trip::class);

}


public function company()
{
    return $this->belongsTo(Company::class);
}


}
