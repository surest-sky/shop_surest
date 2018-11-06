<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $code = setcode(5);
        factory('App\Models\Admin', 3)->create([
            'password' => eny('123456',$code),
            'salt' => $code
        ]);
    }
}
