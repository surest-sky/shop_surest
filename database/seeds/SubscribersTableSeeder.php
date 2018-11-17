<?php

use Illuminate\Database\Seeder;

use App\Models\Subscriber;

class SubscribersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $faker = Faker\Factory::create();

        $emails = [
            '1562135624@qq.com',
            '153921488@qq.com'
        ];

        foreach ($emails as $email) {
            Subscriber::create([
                'email' => $email
            ]);
        }
    }
}
