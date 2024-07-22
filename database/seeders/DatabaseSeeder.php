<?php

namespace Database\Seeders;

use App\Models\Catalogs\BrochureType;
use App\Models\Operation\ViewBuilder;
use Database\Seeders\Catalogs\ARPatternSeeder;
use Database\Seeders\Catalogs\AvailabilitySeeder;
use Database\Seeders\Catalogs\BrochureTypeSeeder;
use Database\Seeders\Catalogs\BussinessTypeCatalogTypeSeeder;
use Database\Seeders\Catalogs\BussinessTypeSeeder;
use Database\Seeders\Catalogs\CatalogTypeProductTypeSeeder;
use Database\Seeders\Catalogs\CatalogTypeSeeder;
use Database\Seeders\Catalogs\FeatureSeeder;
use Database\Seeders\Catalogs\LinkTypeSeeder;
use Database\Seeders\Catalogs\NotificationStatusSeeder;
use Database\Seeders\Catalogs\OrderStatusSeeder;
use Database\Seeders\Catalogs\PaymentStatusSeeder;
use Database\Seeders\Catalogs\ProductTypeFeatureSeeder;
use Database\Seeders\Catalogs\ProductTypeSeeder;
use Database\Seeders\Catalogs\ProductTypeUnitSeeder;
use Database\Seeders\Catalogs\SpecificationTypeSeeder;
use Database\Seeders\Catalogs\StatusSeeder;
use Database\Seeders\Catalogs\SubscriptionStatusSeeder;
use Database\Seeders\Catalogs\ThemesSeeder;
use Database\Seeders\Catalogs\ThemesTypeSeeder;
use Database\Seeders\Catalogs\UnitSeeder;
use Database\Seeders\Catalogs\ViewerStatusSeeder;
use Database\Seeders\Operation\ViewBuilderSeeder;
use Database\Seeders\Operation\VisitorSeeder;
use Database\Seeders\Resources\B2bSeeder;
use Database\Seeders\Resources\CatalogSeeder;
use Database\Seeders\Transactions\PlanSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        /**
         * CATALOGS SEEDERS
         */
        $this->call([

            /** CATALOGS **/
            StatusSeeder::class,
            OrderStatusSeeder::class,
            PaymentStatusSeeder::class,
            NotificationStatusSeeder::class,
            SubscriptionStatusSeeder::class,
            ViewerStatusSeeder::class,


            ARPatternSeeder::class,
            AvailabilitySeeder::class,
            CatalogTypeSeeder::class,
            ProductTypeSeeder::class,
            UnitSeeder::class,
            BussinessTypeSeeder::class,
            FeatureSeeder::class,
            LinkTypeSeeder::class,
            SpecificationTypeSeeder::class,

            CatalogTypeProductTypeSeeder::class,
            ProductTypeFeatureSeeder::class,
            ProductTypeUnitSeeder::class,
            BussinessTypeCatalogTypeSeeder::class,
            BrochureTypeSeeder::class,
            ThemesTypeSeeder::class,
            ThemesSeeder::class,


            PlanSeeder::class,




            /** RESOURCES **/
            B2bSeeder::class,
            UserSeeder::class,

//            CatalogSeeder::class,


//            ViewBuilderSeeder::class,
//            VisitorSeeder::class,

        ]);

//        User::create([
//            "email"=>
//        ]);
    }
}
