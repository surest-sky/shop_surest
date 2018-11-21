<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\AddressCacheTrait;

class Address extends Model
{
    use Notifiable;

    public $guarded = [];

    public $hidden = [
        'updated_at',
        'update_at'
    ];
    use SoftDeletes;

    use AddressCacheTrait;

    const key = 'address';

    public static function setData($request)
    {
        $arr = [
            'name' => $request->name ,
            'address' => $request->address,
            'phone' => $request->phone,
            'detail' => $request->detail,
            'user_id' => \Auth::id()
        ];

        return $arr;
    }


    public function getAddressesAttribute($value)
    {
        return $this->address . '-' . $this->detail;
    }

}
