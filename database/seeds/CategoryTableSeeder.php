<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['特色书籍','文学综合馆','教育馆','人文综合馆','经管综合馆','生活馆','计算机馆','励志成功馆','童书馆'];

        foreach ($categories as $category){
            Category::create([
                'name' => $category,
                'description' => '--'
            ]);
        }
    }
}
