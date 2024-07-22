<?php

namespace Database\Factories\Resources;

use App\Models\Catalogs\BussinessType;
use Illuminate\Database\Eloquent\Factories\Factory;

class B2bBussinessTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            "b2b_id" =>"",
            "bussiness_type_id" =>BussinessType::all()->random()->id,
            "status_id" => 1,
        ];
    }
}
