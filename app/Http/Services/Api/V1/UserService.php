<?php

namespace App\Http\Services\Api\V1;

use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function authUser(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }

}
