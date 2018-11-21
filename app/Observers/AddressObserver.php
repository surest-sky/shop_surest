<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/21
 * Time: 20:41
 */

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    public function created(Address $address)
    {
        Address::setAddressByUser($address->user_id);
    }

    public function deleted(Address $address)
    {
        Address::setAddressByUser($address->user_id);
    }

    public function updated(Address $address)
    {
        Address::setAddressByUser($address->user_id);
    }
}