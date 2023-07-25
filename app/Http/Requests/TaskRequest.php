<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->role->name != 'Driver';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'date' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'name' => 'required|string',
            'executive' => 'required|integer',
            'address' => 'required|string',
        ];
    }
}
