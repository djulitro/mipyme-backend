<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Presencial', 'description' => 'Pago en efectivo o transferencia al momento de realizado el servicio.'],
            ['name' => 'Tarjeta de crédito/débito', 'description' => 'Pago con tarjeta de crédito o débito a través de un terminal punto de venta (TPV).'],
        ];

        DB::table('payment_methods')->insert($paymentMethods);
    }
}
