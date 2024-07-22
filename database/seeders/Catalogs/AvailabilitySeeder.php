<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\Availability;
use App\Models\Catalogs\BussinessType;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ["name"=>"Disponible", "render" => true, "status_id"=>1 ],
            ["name"=>"Por Temporada", "render" => true, "status_id"=>1 ],
            ["name"=>"Agotado", "render" => true, "status_id"=>1 ],
            ["name"=>"No disponible", "render" => true, "status_id"=>1 ],
            ["name"=>"Temporalmente no disponible", "render" => true, "status_id"=>1 ],
            ["name"=>"Proximamente", "render" => true, "status_id"=>1 ],
            ["name"=>"Deprecado", "render" => true, "status_id"=>1 ],
            ["name"=>"Eliminado", "render" => true, "status_id"=>1 ],
        ];

        foreach ($data as $d){
            Availability::create([
                "name" => $d["name"],
                "isRenderable" => $d["render"],
                "status_id" => 1
            ]);
        }

    }
}
