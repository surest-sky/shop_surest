<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = Faker\Factory::create('zh_CN');

        factory('App\Models\User', 20)->create()->each(function ($user) use ($factory) {
            $name = $factory->name;
            $user->name = $name;
            $user->save();
        });
    }
}
