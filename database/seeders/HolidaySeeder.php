<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = $data = [
            [ "day" => 1, "month" => 1, "name" => "Año Nuevo" ],
            [ "day" => 18, "month" => 4, "name" => "Viernes Santo" ],
            [ "day" => 19, "month" => 4, "name" => "Sábado Santo" ],
            [ "day" => 1, "month" => 5, "name" => "Día Nacional del Trabajo" ],
            [ "day" => 21, "month" => 5, "name" => "Día de las Glorias Navales" ],
            [ "day" => 20, "month" => 6, "name" => "Día Nacional de los Pueblos Indígenas" ],
            [ "day" => 29, "month" => 6, "name" => "San Pedro y San Pablo" ],
            [ "day" => 16, "month" => 7, "name" => "Día de la Virgen del Carmen" ],
            [ "day" => 15, "month" => 8, "name" => "Asunción de la Virgen" ],
            [ "day" => 18, "month" => 9, "name" => "Independencia Nacional" ],
            [ "day" => 19, "month" => 9, "name" => "Día de las Glorias del Ejército" ],
            [ "day" => 12, "month" => 10, "name" => "Encuentro de Dos Mundos" ],
            [ "day" => 31, "month" => 10, "name" => "Día de las Iglesias Evangélicas y Protestantes" ],
            [ "day" => 1, "month" => 11, "name" => "Día de Todos los Santos" ],
            [ "day" => 8, "month" => 12, "name" => "Inmaculada Concepción" ],
            [ "day" => 25, "month" => 12, "name" => "Navidad" ]
        ];

        foreach ($holidays as $holiday) {
            Holiday::create($holiday);
        }
    }
}
