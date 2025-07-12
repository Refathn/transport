<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trip;
use App\Models\Bus;
use App\Models\City;
use App\Models\Company;
use App\Models\Driver;
use SebastianBergmann\Diff\Diff;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
protected $model=Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
$departure =$this->faker->dateTimeBetween('+1 days' , '+10 days ');

$arrival = (clone $departure )->modify('+'.rand(2,8).'hours');

$durationHours = $arrival->diff($departure)->h;
$durationMinutes = $arrival->diff($departure)->i;
$duration = $durationHours;



        return [
            'departure_city_id' => City::inRandomOrder()->first()?->id,
            'arrival_city_id' => City::inRandomOrder()->first()?->id,
            'bus_id' => Bus::inRandomOrder()->first()?->id,
            'driver_id' => Driver::inRandomOrder()->first()?->id,
            'company_id' => Company::inRandomOrder()->first()?->id,
            'Seat_price'=>$this->faker->randomFloat(2,10,100),
            'depature_dateTime'=>$departure,
            'arrival_dateTime'=>$arrival,
            'duration'=>$duration,

        ];
    }
}
