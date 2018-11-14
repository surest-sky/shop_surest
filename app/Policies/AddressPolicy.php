<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Address;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function deleteOrUpdate(User $user, Address $address)
    {
        if( $user->id === $address->user_id ) {
            return true;
        }

        return false;
    }
}
