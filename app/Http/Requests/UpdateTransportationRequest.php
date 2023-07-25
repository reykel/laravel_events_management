<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransportationRequest extends FormRequest
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
            'type' => 'required|string',
            'airport' => 'required_if:type,Airplane|string',
            'terminal' => 'required_if:type,Airplane|string',
            'airline' => 'required_if:type,Airplane|string',
            'flight_number' => 'required_if:type,Airplane|string',
            'station' => 'required_if:type,Train|string',
            'train_number' => 'required_if:type,Train|string',
            'other_location' => Rule::requiredIf($this->type == 'Others' || $this->type == 'Vehicle'),
            'date' => 'required|string',
            'hotel' => 'required|string',
            'address' => 'required|string',
            'transfer' => 'boolean'
        ];
    }
}
