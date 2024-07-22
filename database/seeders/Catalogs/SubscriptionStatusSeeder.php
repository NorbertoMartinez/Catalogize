<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\Status;
use App\Models\Catalogs\SubscriptionStatus;
use Illuminate\Database\Seeder;

class SubscriptionStatusSeeder extends Seeder
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
            SubscriptionStatus::create([
                "name" => $d,
                "status_id" => Status::DEFAULT
            ]);
        }
        //
    }
}
