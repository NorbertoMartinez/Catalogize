<?php

namespace Database\Factories\Resources;

use Illuminate\Database\Eloquent\Factories\Factory;

class B2bFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->company,
            "fiscal_code" => "demo-demo-121",
            "social_reason" => $this->faker->companySuffix,
            "slogan" => $this->faker->companySuffix,
            "img" => "https://www.gravatar.com/avatar/".md5($this->faker->safeEmail)."?d=retro",
            "telecom" => $this->faker->phoneNumber,
            "address" => $this->faker->address,
            "status_id" => "1",
        ];
    }
}
