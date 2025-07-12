<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Driver;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
$this->call([
CitiesSeeder::class,
DriverSeeder::class,
CompanySeeder::class,
BusSeeder::class,
TripSeeder::class,


]);



        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
