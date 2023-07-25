<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->role->name == 'Driver';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comment' => 'nullable|string',
            'executives' => 'array|min:1',
            'executives.*' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'executives.min' => 'Select at least 1 executive.',
        ];
    }
}