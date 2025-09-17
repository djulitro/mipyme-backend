<?php

namespace Database\Seeders;

use App\Models\StatusReservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusReservationSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['name' => 'Pending', 'description' => 'Reservation is pending confirmation.'],
            ['name' => 'Confirmed', 'description' => 'Reservation has been confirmed.'],
            ['name' => 'Cancelled', 'description' => 'Reservation has been cancelled.'],
            ['name' => 'Completed', 'description' => 'Reservation has been completed.'],
        ];

        foreach ($status as $item) {
            StatusReservation::create($item);
        }
    }
}
