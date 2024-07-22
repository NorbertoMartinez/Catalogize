<?php

namespace Database\Seeders\Resources;

use App\Models\Resources\B2b;
use App\Models\Resources\B2bBussinessType;
use Illuminate\Database\Seeder;

class B2bSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        B2b::factory(10)
            ->has(B2bBussinessType::factory(1)
                ->state(function(array $atts, B2b $b2b){
                    return ["b2b_id"=>$b2b->id];

                }))->create();
    }
}
