<?php

namespace Database\Seeders\Operation;

use App\Models\Operation\ViewBuilder;
use Illuminate\Database\Seeder;

class ViewBuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ViewBuilder::factory(12)->create();
    }
}
