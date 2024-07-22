<?php

namespace Database\Factories\Catalogs;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThemesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => "",
            "theme_type_id" => 1,
            "status_id" => 1,
        ];
    }
}
