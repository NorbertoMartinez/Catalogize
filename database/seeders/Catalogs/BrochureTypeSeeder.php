<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\BrochureType;
use FontLib\Table\Type\name;
use Illuminate\Database\Seeder;

class BrochureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brochures_type = [
            "Video",
            "Imagen",
            "Modelo 3D",
            "Canción",
        ];


        foreach ($brochures_type as $brochure_type){

            BrochureType::factory(1)->create([
                "name" => $brochure_type,
                "status_id" => 1,
            ]);

        }

    }
}
