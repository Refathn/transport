<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{



public function user(){
    return $this->belongsTo(User::class);
}
public function trip()
{

return $this->belongsTo(Trip::class);

}
}
