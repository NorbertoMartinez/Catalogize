<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\BussinessTypeCatalogType;
use Illuminate\Database\Seeder;

class BussinessTypeCatalogTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ["bid"=>1, "cid" => 1],
            ["bid"=>1, "cid" => 3],
            ["bid"=>2, "cid" => 2],
            ["bid"=>2, "cid" => 3],
            ["bid"=>3, "cid" => 2],
            ["bid"=>3, "cid" => 3],
            ["bid"=>4, "cid" => 3],
            ["bid"=>5, "cid" => 4],
        ];

        foreach ($data as $d){
            BussinessTypeCatalogType::create([
                "bussiness_type_id" => $d["bid"],
                "catalog_type_id" => $d["cid"],
                "status_id" => 1
            ]);
        }
    }
}
