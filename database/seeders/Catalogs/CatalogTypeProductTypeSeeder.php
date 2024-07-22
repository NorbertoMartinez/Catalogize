<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\CatalogTypeProductType;
use Illuminate\Database\Seeder;

class CatalogTypeProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["catalog"=>1, "product" => 1],
            ["catalog"=>1, "product" => 2],
            ["catalog"=>1, "product" => 3],
            ["catalog"=>1, "product" => 4],
            ["catalog"=>1, "product" => 5],
            ["catalog"=>2, "product" => 6],
            ["catalog"=>2, "product" => 7],
            ["catalog"=>2, "product" => 8],
            ["catalog"=>2, "product" => 9],
            ["catalog"=>2, "product" => 10],
            ["catalog"=>2, "product" => 14],
            ["catalog"=>2, "product" => 15],
            ["catalog"=>3, "product" => 6],
            ["catalog"=>3, "product" => 7],
            ["catalog"=>3, "product" => 8],
            ["catalog"=>3, "product" => 9],
            ["catalog"=>3, "product" => 16],
            ["catalog"=>3, "product" => 17],
            ["catalog"=>4, "product" => 6],
            ["catalog"=>4, "product" => 11],
            ["catalog"=>4, "product" => 12],
            ["catalog"=>4, "product" => 13],
            ["catalog"=>4, "product" => 14],
            ["catalog"=>4, "product" => 15],


        ];

        foreach ($data as $d){
            CatalogTypeProductType::create([
                "catalog_type_id" => $d["catalog"],
                "product_type_id" => $d["product"],
                "status_id" => 1
            ]);
        }
    }
}
