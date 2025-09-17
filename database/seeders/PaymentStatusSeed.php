<?php

namespace Database\Seeders;

use App\Models\StatusPayment;
use Illuminate\Database\Seeder;

class PaymentStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['name' => 'Pending', 'description' => 'Payment is pending'],
            ['name' => 'Completed', 'description' => 'Payment is completed'],
            ['name' => 'Failed', 'description' => 'Payment has failed'],
            ['name' => 'Cancelled', 'description' => 'Payment was cancelled'],
            ['name' => 'Refunded', 'description' => 'Payment has been refunded'],
            ['name' => 'Expired', 'description' => 'Payment has expired'],
        ];

        foreach ($status as $s) {
            StatusPayment::create($s);
        }
    }
}
