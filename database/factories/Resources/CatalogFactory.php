<?php

namespace Database\Factories\Resources;

use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "hash"=> base64_encode($this->faker->time),
            "background"=> "https://www.gravatar.com/avatar/".md5($this->faker->safeEmail)."?d=retro",
            "theme"=> 1,
            "qr_code"=> "",
            "name"=> $this->faker->name,
            "description"=> $this->faker->text,
            "b2b_id"=> 1,
            "catalog_type_id"=> 1,
            "status_id"=> Status::DEFAULT,
        ];
    }
}
