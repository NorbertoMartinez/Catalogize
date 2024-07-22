<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Plato/s",
            "Pieza/s",
            "Unidad/es",
            "Vaso/s",
            "Caja/s",
            "Copa/s",
            "Jarra/s",
            "Litro/s",
            "Taza/s",
            "Bolsa/s",
            "Paquete/s",
            "Servicio/s",
            "Obra/s",
            "Lugar/es",
            "Actividad/es",
        ];

        foreach ($data as $d){
            Unit::create([
                "name" => $d,
                "status_id" => 1
            ]);
        }
    }
}
