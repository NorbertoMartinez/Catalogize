<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\ThemesType;
use Illuminate\Database\Seeder;

class ThemesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [
            ["status_id"=> 1, "name" => "Catalogo",],
            ["status_id"=> 1, "name" => "Folleto",],
        ];

        foreach ($themes as $theme){
            ThemesType::factory(1)->create($theme);
        }
    }
}
