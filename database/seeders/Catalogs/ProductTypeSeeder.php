<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name"=>"Alimento", "description" => "demo"],
            ["name"=>"Postre", "description" => "demo"],
            ["name"=>"Bebida ", "description" => "demo"],
            ["name"=>"Bebida Alcoholica", "description" => "demo"],
            ["name"=>"Bebida Otra", "description" => "demo"],
            ["name"=>"Servicio Profesional", "description" => "demo"],
            ["name"=>"Atencion al cliente", "description" => "demo"],
            ["name"=>"Soporte tecnico", "description" => "demo"],
            ["name"=>"Servicio general", "description" => "demo"],
            ["name"=>"Revision", "description" => "demo"],
            ["name"=>"Exposicion", "description" => "demo"],
            ["name"=>"Presentacion", "description" => "demo"],
            ["name"=>"Invitacion", "description" => "demo"],
            ["name"=>"Reservacion", "description" => "demo"],
            ["name"=>"Actividad", "description" => "demo"],
            ["name"=>"Unidad", "description" => "demo"],
            ["name"=>"Producto ", "description" => "demo"],
        ];

        foreach ($data as $d){
            ProductType::create([
                "name" => $d["name"],
                "description" => $d["description"],
                "status_id" => 1
            ]);
        }
    }
}
