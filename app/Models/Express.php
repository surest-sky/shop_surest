<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Handle\ExpressHandler;

class Express extends Model
{
    public $fillable = [
        'serial','name'
    ];

    public static function getAll()
    {
        return self::query()->select('serial','name')->get();
    }

    public static function getDetail($data)
    {
        $handler = new ExpressHandler();
        $result = $handler->getOrderTracesByJson($data['serial'],$data['no']);
        return $result;
    }
}
