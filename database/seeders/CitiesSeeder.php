<?php

namespace Database\Seeders;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities=['DAMASCUS','ALEEPO','HAMA','IDLEP','LATAKIA','TARTOOUS' ];
        foreach($cities as $city )
        {

City::create([
    'name'=>$city,
]);

        }
    }
}
