<?php

namespace Database\Seeders\Resources;

use Illuminate\Database\Seeder;

class BrochureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return [
            "name"=>1,
            "description"=>1,
            "src"=>1,
            "link"=>1,
            "pattern"=>1,
            "status_id"=>1,
            "b2b_id"=>1,
            "hash"=>1,
        ];
    }
}
