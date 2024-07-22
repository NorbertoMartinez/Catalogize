<?php

namespace Database\Seeders;

use App\Models\Resources\B2b;
use App\Models\Resources\B2bBussinessType;
use App\Models\User;
use App\Models\UserB2b;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0 ; $i <= 2 ; $i++){

            User::factory(1)


                ->has(UserB2b::factory(2)
                    ->state(function (array $atts, User $user){
                        $b2b=B2b::all()->random();
                        return [
                            "user_id" => $user->id,
                            "b2b_id" => $b2b->id,
                        ];
                    })
                )
                ->create([
                    "email" => "u".$i."@catalogize.com",
                    "b2b_id" => 1,

                ])->each(function ($user){
                    $user->createOrGetStripeCustomer();
                });
        }
    }
}
