<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Cantidad ",
            "Caliente/Frio",
            "Porcion/es",
            "Tamano",
            "Descripcion",
            "Especificacion",
            "Duracion/Tiempo",
            "Especificaciones Mecanicas",
            "Especificaciones Tecnicas",
            "Especificaciones Generales",
            "Color",
            "Dimensiones",
            "Largo",
            "Ancho",
            "Altura",
            "Peso",
            "Estilo",
            "Diseno",
        ];

        foreach ($data as $d){
            feature::create([
                "name" => $d,
                "status_id" => 1
            ]);
        }
    }
}
