<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/22
 * Time: 0:55
 */

namespace App\Scope;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductScope implements Scope
{
    public function apply(Builder $builder,Model $model)
    {
        return $builder->where('actived',1);
    }
}