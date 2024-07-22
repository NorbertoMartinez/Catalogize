<?php

namespace Database\Factories\Operation;

use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "location" => $this->faker->localIpv4,
            "timezone" => time(),
            "referer" => $this->faker->ipv4,
            "time_active" => $this->faker->randomNumber(3),
//            "hot_zones" => $this->faker->time,
            "clicks" => 99,
            "isGuest" => true,
            "view_builder_id" => 1,
            "status_id" => Status::DEFAULT,
        ];
    }
}
