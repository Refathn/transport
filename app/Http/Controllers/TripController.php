<?php

namespace App\Http\Controllers;
use App\models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripController extends Controller
{

    public function searchTrips(Request $request)
    {
        $request->validate([
            'from_city' => 'required|exists:cities,id',
            'to_city' => 'required|exists:cities,id',
            // اختياري: 'date' => 'date',
        ]);


    //    $trips=Trip::find(1);

        $trips = Trip::with(['bus', 'driver', 'bookings'])
            ->where('departure_city_id', $request->from_city)
            ->where('arrival_city_id', $request->to_city)
            ->where('depature_dateTime', '>', Carbon::now())
            ->get()
            // ->filter(function ($trip) {
            //     $totalSeats = $trip->bus->seats_count;
            //     $booked = $trip->bookings->sum('seats_booked');
            //     return $totalSeats > $booked;
            // })
            // ->values()
            ->map(function($trips)
            {
                 $totalSeats = $trips->bus->seats_count;
                 $booked = $trips->bookings->sum('seats_booked');
                 $seats_available= $totalSeats-$booked;

                return [
                    'trip_id' => $trips->id,
                    'from' => $trips->departureCity->name,
                    'from_city_id' => $trips->departure_city_id,
                    'to' => $trips->arrivalCity->name,
                    'to_city_id' => $trips->arrival_city_id,
                    'departure_time' => $trips->depature_dateTime,
                    'arrival_time' => $trips->arrival_dateTime,
                    'price'=>$trips->Seat_price,
                    'duration'=>$trips->duration,
                    'seats_booked'=>$booked,
                    'total_seats'=>$totalSeats,
                    'available'=>$seats_available,

                ];


            });


        return response()->json($trips);
    }




    public function tripDetails($id)
    {
        $trip = Trip::with(['bus', 'driver', 'bookings'])->findOrFail($id);

        $totalSeats = $trip->bus->seats_count;
        $booked = $trip->bookings->sum('seats_booked');
        $available = $totalSeats - $booked;

        // تحديد حالة الرحلة تلقائيًا
        if (Carbon::now()->gt($trip->arrival_dateTime)) {
            $status = 'completed';
        } elseif ($available <= 0) {
            $status = 'fully_booked';
        } else {
            $status = 'active';
        }

        return response()->json([
            'trip_id' => $trip->id,
                    'from' => $trip->departureCity->name,
                    'to' => $trip->arrivalCity->name,
                    'departure_time' => $trip->depature_dateTime,
                    'arrival_time' => $trip->arrival_dateTime,
                    'price'=>$trip->Seat_price,
                    'duration'=>$trip->duration,
                    'seats_booked'=>$booked,
                    'total_seats'=>$totalSeats,
                    'available'=>$available,
            'bus' => [
                'id' => $trip->bus->id,
                'model' => $trip->bus->model,
                'seats_number' => $totalSeats,
            ],

            'driver' => [
                'id' => $trip->driver->id,
                'name' => $trip->driver->name,
                'phone' => $trip->driver->phone,
            ],

            'booked_seats' => $booked,
            'available_seats' => $available,
            'status' => $status,
        ]);
    }



}
