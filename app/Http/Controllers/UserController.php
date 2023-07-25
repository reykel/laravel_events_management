<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\DriverRegistrationConfirmationMail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * @return Response
     */
    public function verify(): Response
    {
        return Inertia::render('Auth/Verify', []);
    }

    /**
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function check(Request $request): Redirector|Application|RedirectResponse
    {
        $code = $request->code;
        $user = Auth::user();
        if ($code == $user->code) {
            $user->confirmed = 1;
            $user->save();
            $ref = Cookie::get('ref');
            // Cookie::queue('ref', null, 10);

            if ($user->role->name == 'Admin') {
                if ($ref != null)
                    return Redirect::to($ref);
                return redirect(route('executives_list'));
            }
            return redirect(route('driver_list'));
        }
        return redirect()->back()->with('message', [
            'text' => 'The code entered is not valid',
            'type' => 'error'
        ]);
    }

    public function unauthorized(): Response
    {
        return Inertia::render('Unauthorized', []);
    }

    public function unauthorized2(): Response
    {
        return Inertia::render('Unauthorized2', []);
    }

    public function registerSuccess(): Response
    {
        return Inertia::render('RegisterSuccess', []);
    }
    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function accept(Request $request, $id): RedirectResponse
    {
        if (Auth::user()->role->name == 'Admin') {
            $user = User::find($id);
            if ($user) {
                $user->active = true;
                $user->save();
                Mail::to($user->email)->send(new DriverRegistrationConfirmationMail(['result' => 'approved']));
                Cookie::forget('ref');
                return redirect()->route('executives_list')->with('message', [
                    'text' => 'User approved',
                    'type' => 'success'
                ]);
            } else {
                return redirect()->route('executives_list')->with('message', [
                    'text' => 'User not found',
                    'type' => 'error'
                ]);
            }
        } else {
            return redirect()->route('unauthorized2');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function reject(Request $request, $id): RedirectResponse
    {
        if (Auth::user()->role->name == 'Admin') {
            $user = User::find($id);
            if ($user) {
                $user->active = false;
                $user->save();
                Mail::to($user->email)->send(new DriverRegistrationConfirmationMail(['result' => 'rejected']));
                Cookie::forget('ref');
                return redirect()->route('executives_list')->with('message', [
                    'text' => 'User rejected',
                    'type' => 'success'
                ]);
            } else {
                return redirect()->route('executives_list')->with('message', [
                    'text' => 'User not found',
                    'type' => 'error'
                ]);
            }
        } else {
            return redirect()->route('unauthorized2');
        }
    }
}
