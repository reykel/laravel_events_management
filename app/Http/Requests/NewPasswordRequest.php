<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6',
            'repeatNewPassword' => 'required|same:newPassword',
        ];
    }
    public function messages()
    {
        return [
            'currentPassword.required' => 'The current password field is required.',
            'newPassword.required' => 'The current password field is required.',
            'repeatNewPassword.required' => 'The current password field is required.',
            'newPassword.min' => 'The new password field needs at least 6 characters.',
            'repeatNewPassword.same' => 'The new password doesn\'t  match in both fields.',
        ];
    }
}
