<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/20
 * Time: 16:34
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends \Eloquent
{
    public function scopeWithOnly($query, $relation, Array $columns)
    {
        return $query->with([$relation => function ($query) use ($columns){
            $query->select(array_merge(['id'], $columns));
        }]);
    }
}