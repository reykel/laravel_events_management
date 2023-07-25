<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {
        /*
        $user = Auth::user();
        if ($user->role->name == 'Admin') {
            return redirect(route('executives_list'));
        } else {
        */
            Auth::logout();
            //if ($user->role->name == 'Driver' && $user->active == false) {
                return redirect(route('register_success'));
            //}
        //}
    }
}
