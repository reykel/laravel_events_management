<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{

    public function toResponse($request)
    {
        $code = $request->id;
        $user = null;
        if($code){
            $user = User::where('id', $code)->first();
        }
        /*
       if($user){
           $user->confirmed = false;
           $user->save();
       }
       */

        return redirect('login');
    }

}
