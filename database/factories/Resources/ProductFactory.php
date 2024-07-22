<?php

namespace Database\Factories\Resources;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            "hash"=> base64_encode($this->faker->name),
            "name"=> $this->faker->name,
            "description"=> $this->faker->text,
            "img"=> "https://www.gravatar.com/avatar/".md5($this->faker->safeEmail)."?d=robohash",
            "sku"=> $this->faker->userName,
            "isStockeable"=> $this->faker->boolean,
            "stock"=> $this->faker->randomDigit(),
            "isGlobalPrice"=> $this->faker->boolean,
            "price"=> $this->faker->randomNumber(3),
            "parent_product_id"=> 0,
            "availability_id"=> 1,
            "product_type_id"=> 1,
            "unit_id"=> 1,
            "status_id"=> 1,
            "b2b_id"=> 1,

        ];
    }
}
