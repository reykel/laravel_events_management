<?php

namespace App\Actions\Fortify;

use App\Mail\CodeMail;
use App\Mail\DriverRegisteredMail;
use App\Mail\DriverRegistrationMail;
use App\Mail\DriverRegistrationConfirmationMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return User
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required']
        ])->validate();

        $role = Role::where('name', $input['user'])->first();

        $user = User::create([
            'name' => $input['email'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'role_id' => 1,//$role->id,
            'password' => Hash::make($input['password']),
            'active' => 1,
        ]);

        $details = [
            'url' => env('APP_URL', 'http://localhost'),
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone
        ];
        try {
            //if ($role->name == 'Driver'){
                Mail::to(['jsanchez@iberdrola.com','protocolo_ib@iberdrola.es'])->send(new DriverRegistrationMail($details)); //send to jsanchezb@iberdrola.es
                Mail::to($user->email)->send(new DriverRegisteredMail($user->name));
                //Mail::to($user->email)->send(new DriverRegistrationConfirmationMail($user->name));
            //}
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return $user;
    }
}
