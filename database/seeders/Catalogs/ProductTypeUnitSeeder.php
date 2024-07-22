<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\ProductTypeUnit;
use Illuminate\Database\Seeder;

class ProductTypeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            ["pid"=>1, "unid" => 1],
            ["pid"=>1, "unid" => 2],
            ["pid"=>1, "unid" => 3],
            ["pid"=>2, "unid" => 1],
            ["pid"=>2, "unid" => 2],
            ["pid"=>2, "unid" => 3],
            ["pid"=>3, "unid" => 4],
            ["pid"=>3, "unid" => 6],
            ["pid"=>3, "unid" => 7],
            ["pid"=>3, "unid" => 8],
            ["pid"=>3, "unid" => 9],
            ["pid"=>4, "unid" => 4],
            ["pid"=>4, "unid" => 6],
            ["pid"=>4, "unid" => 7],
            ["pid"=>4, "unid" => 8],
            ["pid"=>4, "unid" => 9],
            ["pid"=>5, "unid" => 4],
            ["pid"=>5, "unid" => 6],
            ["pid"=>5, "unid" => 7],
            ["pid"=>5, "unid" => 8],
            ["pid"=>5, "unid" => 9],
            ["pid"=>6, "unid" => 2],
            ["pid"=>6, "unid" => 11],
            ["pid"=>6, "unid" => 12],
            ["pid"=>6, "unid" => 15],
            ["pid"=>7, "unid" => 3],
            ["pid"=>7, "unid" => 11],
            ["pid"=>7, "unid" => 12],
            ["pid"=>7, "unid" => 15],
            ["pid"=>8, "unid" => 3],
            ["pid"=>8, "unid" => 11],
            ["pid"=>8, "unid" => 12],
            ["pid"=>8, "unid" => 15],
            ["pid"=>9, "unid" => 3],
            ["pid"=>9, "unid" => 11],
            ["pid"=>9, "unid" => 12],
            ["pid"=>9, "unid" => 15],
            ["pid"=>10, "unid" => 3],
            ["pid"=>10, "unid" => 11],
            ["pid"=>10, "unid" => 12],
            ["pid"=>10, "unid" => 15],
            ["pid"=>11, "unid" => 2],
            ["pid"=>11, "unid" => 3],
            ["pid"=>11, "unid" => 13],
            ["pid"=>11, "unid" => 14],
            ["pid"=>11, "unid" => 15],
            ["pid"=>12, "unid" => 2],
            ["pid"=>12, "unid" => 3],
            ["pid"=>12, "unid" => 13],
            ["pid"=>12, "unid" => 14],
            ["pid"=>12, "unid" => 15],
            ["pid"=>13, "unid" => 13],
            ["pid"=>13, "unid" => 14],
            ["pid"=>13, "unid" => 15],
            ["pid"=>14, "unid" => 11],
            ["pid"=>14, "unid" => 12],
            ["pid"=>14, "unid" => 13],
            ["pid"=>14, "unid" => 14],
            ["pid"=>14, "unid" => 15],
            ["pid"=>15, "unid" => 3],
            ["pid"=>15, "unid" => 12],
            ["pid"=>15, "unid" => 13],
            ["pid"=>15, "unid" => 14],
            ["pid"=>15, "unid" => 15],
            ["pid"=>16, "unid" => 2],
            ["pid"=>16, "unid" => 3],
            ["pid"=>16, "unid" => 5],
            ["pid"=>16, "unid" => 10],
            ["pid"=>16, "unid" => 11],
            ["pid"=>16, "unid" => 12],
            ["pid"=>16, "unid" => 15],
            ["pid"=>17, "unid" => 2],
            ["pid"=>17, "unid" => 3],
            ["pid"=>17, "unid" => 5],
            ["pid"=>17, "unid" => 10],
            ["pid"=>17, "unid" => 11],
        ];

        foreach ($data as $d){
            ProductTypeUnit::create([
                "product_type_id" => $d["pid"],
                "unit_id" => $d["unid"],
                "status_id" => 1
            ]);
        }
    }
}
