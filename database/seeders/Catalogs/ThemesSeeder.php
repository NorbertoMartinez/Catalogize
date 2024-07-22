<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\BussinessType;
use App\Models\Catalogs\ThemeBussiness;
use App\Models\Catalogs\Themes;
use Illuminate\Database\Seeder;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//        "Restaurante/Alimentos/Bebidas",
//            "Servicios varios",
//            "Servicios profesionales",
//            "Venta Productos",
//            "Turismo y cultura",

        $themes = [
            ["bussiness" => [1], "theme_type_id" => "1", "name" => "Menú Contemporaneo",],
            ["bussiness" => [1], "theme_type_id" => "1", "name" => "Menú Clásico",],
            ["bussiness" => [1], "theme_type_id" => "1", "name" => "Menú Moderno",],
            ["bussiness" => [1], "theme_type_id" => "1", "name" => "Default",],
            ["bussiness" => [2,3,4], "theme_type_id" => "1", "name" => "Catálogo de servicios Moderno",],
            ["bussiness" => [2,3,4], "theme_type_id" => "1", "name" => "Catálogo de servicios clásico",],
            ["bussiness" => [2,3,4], "theme_type_id" => "1", "name" => "Catálogo de servicios Moderno",],
            ["bussiness" => [2,3,4], "theme_type_id" => "1", "name" => "Default",],
            ["bussiness" => [5], "theme_type_id" => "1", "name" => "Catálogo de eventos 1",],
            ["bussiness" => [5], "theme_type_id" => "1", "name" => "Default",],
        ];

        foreach ($themes as $theme) {

            Themes::factory(1)
                ->has(
                    ThemeBussiness::factory(1)->state(function(array $atts, Themes $themes){
                        return [
                          "theme_id" => $themes->id,
                          "bussiness_type_id" => 1,
                        ];

                    })
            )->create(
                    [
                        "name" => $theme["name"],
                        "theme_type_id" => $theme["theme_type_id"],
                    ]
                );

        }

    }
}
