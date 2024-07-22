<?php

namespace Database\Seeders\Resources;

use App\Models\Catalogs\CatalogType;
use App\Models\Catalogs\Status;
use App\Models\Resources\B2b;
use App\Models\Resources\Catalog;
use App\Models\Resources\CatalogSection;
use App\Models\Resources\Product;
use App\Models\Resources\Section;
use App\Models\Resources\SectionProduct;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $_catalog = null;
        Catalog::factory(10)->state(function(){
            $b2b = B2b::all()->random(1)->first();
            return [
                "b2b_id" => $b2b->id,
            ];
        })->create()
            ->each(function ($catalog){


            $sections = Section::factory(5)->create()
                ->each(function($section){

                    $products = Product::factory(12)->create();

                    foreach($products as $product){
                        SectionProduct::create([
                            "product_id" => $product->id,
                            "section_id" => $section->id,
                            "catalog_id" => 1,
                            "status_id" => Status::DEFAULT,
                        ]);
                    }

                });

            foreach($sections as $section){
                CatalogSection::create([
                    "catalog_id" => $catalog->id,
                    "section_id" => $section->id,
                    "status_id" => Status::DEFAULT,
                ]);
            }
        }
        );
    }
}
