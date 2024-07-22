<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\LinkType;
use Illuminate\Database\Seeder;

class LinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Facebook",
            "Twitter",
            "Instagram",
            "500px",
            "Flickr",
            "UberEats",
            "Rappi",
            "WebSite",
        ];

        foreach ($data as $d){
            LinkType::create([
                "name" => $d,
                "status_id" => 1
            ]);
        }
        //
    }
}
