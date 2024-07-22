<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\Status;
use App\Models\Catalogs\ViewerStatus;
use Illuminate\Database\Seeder;

class ViewerStatusSeeder extends Seeder
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
            "Bloqueado",
            "Eliminado",
            "Deprecado",
        ];


        foreach ($data as $d){
            ViewerStatus::create([
                "name" => $d,
                "status_id" => Status::DEFAULT
            ]);
        }
    }
}
