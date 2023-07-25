<?php

namespace App\Http\Responses;

use App\Mail\CodeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $user = Auth::user();
        if ($user) {
            if (!$user->active) {
                Auth::logout();
                return redirect(route('unauthorized'));
            }else{
                if ($user->confirmed != 1) {
                    $user->code =  mt_rand(1111, 9999);
                    $user->save();
                    try {
                        Mail::to($user->email)->send(new CodeMail($user->code));
                    } catch (\Exception $exception) {
                        Log::error($exception->getMessage());
                    }
                    return redirect('verify-code');
                }else{
                    return redirect('/');
                }
            }
            
        }
    }
}
