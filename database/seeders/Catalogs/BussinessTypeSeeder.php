<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\BussinessType;
use Illuminate\Database\Seeder;

class BussinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            "Restaurante/Alimentos/Bebidas",
            "Servicios varios",
            "Servicios profesionales",
            "Venta Productos",
            "Turismo y cultura",
        ];

        foreach ($data as $d){
            BussinessType::create([
                "name" => $d,
                "status_id" => 1
            ]);
        }

    }
}
