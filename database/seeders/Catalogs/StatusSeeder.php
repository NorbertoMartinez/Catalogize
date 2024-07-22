<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $data = [
            "Activo",
            "Inactivo",
            "Suspendido",
            "En revision",
            "Bloqueado",
            "Eliminado",
            "Deprecado",
        ];


        foreach ($data as $d){
            Status::create([
                "name" => $d,
            ]);
        }
    }
}
