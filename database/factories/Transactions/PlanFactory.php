<?php

namespace Database\Factories\Transactions;

use App\Models\Catalogs\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->monthName,
            "description"=>$this->faker->text,
            "price_per_month"=>$this->faker->randomNumber(5, false),
            "price_per_year"=>$this->faker->randomNumber(5, false),
            "discount"=>$this->faker->randomNumber(5, false),
            "image"=>"https://",
            "catalogs_per_plan"=>$this->faker->randomNumber(2, false),
            "brochures_per_plan"=>$this->faker->randomNumber(2, false),
            "sections_per_plan"=>$this->faker->randomNumber(2, false),
            "products_per_plan"=>$this->faker->randomNumber(2, false),
            "isReportable"=>$this->faker->boolean,
            "isMarketing"=>$this->faker->boolean,
            "isMessageCenter"=>$this->faker->boolean,
            "status_id"=>Status::DEFAULT,
        ];
    }
}
