<?php
/**
 * Created by PhpStorm.
 * User: surest
 * Date: 2018/12/6
 * Time: 17:19
 */

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function delete(Category $category)
    {
        Category::setRedisCategory();
    }

    public function update(Category $category)
    {
        Category::setRedisCategory();
    }

    public function create(Category $category)
    {
        Category::setRedisCategory();
    }
}