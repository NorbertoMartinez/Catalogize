<?php

namespace Database\Seeders\Operation;

use App\Models\Operation\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visitor::factory(200)->create();
    }
}
