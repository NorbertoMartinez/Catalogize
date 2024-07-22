<?php

namespace Database\Factories\Resources;

use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            "background" => "https://www.gravatar.com/avatar/".md5($this->faker->safeEmail)."?d=retro",
            "hash" => base64_encode($this->faker->name),
            "title" => $this->faker->name,
            "subtitle" => $this->faker->text,
            "description" => $this->faker->text,
            "status_id" => Status::DEFAULT,
        ];
    }
}
