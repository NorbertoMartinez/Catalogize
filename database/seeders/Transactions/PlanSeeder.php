<?php

namespace Database\Seeders\Transactions;

use App\Models\Transactions\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::factory(3)->create();
    }
}
