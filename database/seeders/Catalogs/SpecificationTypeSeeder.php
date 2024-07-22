<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\SpecificationType;
use Illuminate\Database\Seeder;

class SpecificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Tabs",
            "Colapsable",
            "Normal",
        ];

        foreach ($data as $d){
            SpecificationType::create([
                "name" => $d,
                "status_id" => 1
            ]);
        }
    }
}
