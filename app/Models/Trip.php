<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
use HasFactory;

protected $fillable=['departure_city_id','arrival_city_id','bus_id','driver_id','bus_id','Seat_price','depature_dateTime',
'arrival_dateTime','duration'];
    public function ratings()
    {
return $this->morphMany(Rating::class,'rateable');


    }


public function company()
{

    return $this->belongsTo(Company::class);
}



public function bus()
{
    return $this->belongsTo(Bus::class);
}


public function driver()
{
    return $this->belongsTo(Driver::class);
}



public function departureCity()
{
    return $this->belongsTo(City::class,'departure_city_id');
}
public function arrivalCity()
{
    return $this->belongsTo(City::class,'arrival_city_id');
}
public function bookings()
{
    return $this->hasMany(Booking::class);
}
}
