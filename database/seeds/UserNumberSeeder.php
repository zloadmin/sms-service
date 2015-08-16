<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\User;
use App\NumbersGroup;
use App\Numbers;

class UserNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ru_RU');



        foreach(User::all() as $user) {

            for($i=0;$i<=rand(0,10);$i++) {
                NumbersGroup::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence($nbWords = rand(1, 10))
                ]);
            }

        }

        foreach(NumbersGroup::all() as $number_grop) {

            for($i=0;$i<=rand(0,999);$i++) {

                Numbers::create([
                    'numbers_group_id' => $number_grop->id,
                    'number' => '+7'.rand(1111111111, 9999999999)
                ]);

            }
        }
    }
}
