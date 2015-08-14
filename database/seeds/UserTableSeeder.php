<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<=50;$i++) {
            $faker = Faker::create('en_US');
            $newuser = new User;
            $newuser->nickname = $faker->firstName;
            $newuser->name = $faker->lastName;
            $newuser->email = $faker->email;
            $newuser->avatar = $faker->url;
            $newuser->save();
        }

        for($i=0;$i<=50;$i++) {
            $faker = Faker::create('ru_RU');
            $newuser = new User;
            $newuser->nickname = $faker->firstName;
            $newuser->name = $faker->lastName;
            $newuser->email = $faker->email;
            $newuser->avatar = $faker->url;
            $newuser->save();
        }

    }
}
