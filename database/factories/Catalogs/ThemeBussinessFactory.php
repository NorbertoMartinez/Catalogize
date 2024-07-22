<?php

namespace Database\Factories\Catalogs;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThemeBussinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "bussiness_type_id" => 1,
            "theme_id" => 1,
        ];
    }
}
