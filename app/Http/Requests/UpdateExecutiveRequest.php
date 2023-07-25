<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExecutiveRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string',
            'passport' => 'required|string',
            'nationality' => 'required|string',

            'phone' => 'required|string',
            'phone_code' => 'required|string',
            'mobile' => 'required|string',
            'mobile_code' => 'required|string',
            'allergies' => 'nullable|string',
            'special_needs' => 'nullable|string',

            'arrival_type' => 'required|string',
            'arrival_airport' => 'nullable|string',
            'arrival_terminal' => 'nullable|string',
            'arrival_airline' => 'nullable|string',
            'arrival_flight_number' => 'nullable|string',
            'arrival_station' => 'nullable|string',
            'arrival_train_number' => 'nullable|string',
            'arrival_other_location' => 'nullable|string',

            'arrival_date' => 'required|string',
            'arrival_hotel' => 'required|string',
            'arrival_address' => 'required|string',
            'arrival_transfer' => 'required|boolean',

            'departure_type' => 'required|string',
            'departure_airport' => 'nullable|string',
            'departure_terminal' => 'nullable|string',
            'departure_airline' => 'nullable|string',
            'departure_flight_number' => 'nullable|string',
            'departure_station' => 'nullable|string',
            'departure_train_number' => 'nullable|string',
            'departure_other_location' => 'nullable|string',

            'departure_date' => 'required|string',
            'departure_hotel' => 'required|string',
            'departure_address' => 'required|string',
            'departure_transfer' => 'required|boolean',

            'policy' => 'boolean',
        ];
    }
}
