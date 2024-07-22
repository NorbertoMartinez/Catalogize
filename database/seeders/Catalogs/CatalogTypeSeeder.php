<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\CatalogType;
use Illuminate\Database\Seeder;

class CatalogTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Catálogo de Alimentos/Bebidas",
            "Catálogo de servicios",
            "Catálogo de productos",
            "Catálogo de actividades",
        ];

        foreach ($data as $d){
            CatalogType::create([
                "name" => $d,
                "status_id" => 1
            ]);
        }
    }
}
