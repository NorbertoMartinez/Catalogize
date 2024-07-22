<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\PaymentStatus;
use App\Models\Catalogs\Status;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
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
            PaymentStatus::create([
                "name" => $d,
                "status_id" => Status::DEFAULT
            ]);
        }
        //
    }
}
