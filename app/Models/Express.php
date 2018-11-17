<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Redis\ExpressCache;

class Express extends Model
{
    public $fillable = [
        'serial','name'
    ];

    public static function getAll()
    {
        return self::query()->select('serial','name')->get();
    }

    public static function getDetail($order)
    {
        return ExpressCache::getValue($order->id);
    }
}
