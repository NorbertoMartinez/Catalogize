<?php

namespace Database\Seeders\Catalogs;

use App\Models\Catalogs\ARPattern;
use App\Models\Catalogs\Status;
use Illuminate\Database\Seeder;

class ARPatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $patterns = [
            [
                "name" => "Catalogize",
                "img" => "/patterns/catalogize/img.png",
                "patt" => "/patterns/catalogize/pattern.patt",
                "status_id" => Status::DEFAULT,
            ],
            [
                "name" => "Retro",
                "img" => "/patterns/catalogize/img.png",
                "patt" => "/patterns/catalogize/pattern.patt",
                "status_id" => Status::DEFAULT,
            ],
        ];

        foreach ($patterns as $pattern){
            ARPattern::create($pattern);
        }
    }
}
