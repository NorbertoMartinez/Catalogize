<?php

namespace Database\Factories\Operation;

use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewBuilderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "url" => "http://catalogize.com/viewer/v?=".base64_encode($this->faker->time),
            "hash" => base64_encode($this->faker->time),
            "isQR" => true,
            "catalog_id" => 1,
            "status_id" => Status::DEFAULT,
        ];
    }
}
