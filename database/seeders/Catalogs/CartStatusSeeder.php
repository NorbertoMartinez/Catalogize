<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\CartStatus;
use App\Models\Catalogs\Status;
use Illuminate\Database\Seeder;

class CartStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Pendiente",
            "En proceso",
            "Pagado",
            "Cancelado",
            "Devuelto",
            "Devolución solicitada",
            "Inactivo",
        ];


        foreach ($data as $d){
            CartStatus::create([
                "name" => $d,
                "status_id" => Status::DEFAULT
            ]);
        }
    }
}
