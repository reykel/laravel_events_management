<?php

namespace App\Http\Resources;

use App\Models\Executive;
use App\Models\Transportation;
use Illuminate\Http\Resources\Json\JsonResource;

class ExecutiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'phone_code' => $this->phone_code,
            'mobile' => $this->mobile,
            'mobile_code' => $this->mobile_code,
            'passport' => $this->passport,
            'nationality' => $this->nationality,
            'company' => $this->company,
            'assist' => (bool)$this->assist,
            'arrive_id' => $this->arrive ? new TransportationResource($this->arrive) : '',
            'arrival_type' => $this->arrive ? $this->arrive->type : '',
            'arrival_airport' => $this->arrive ? $this->arrive->airport : '',
            'arrival_terminal' => $this->arrive ? $this->arrive->terminal : '',
            'arrival_airline' => $this->arrive ? $this->arrive->airline : '',
            'arrival_flight_number' => $this->arrive ? $this->arrive->flight_number : '',
            'arrival_station' => $this->arrive ? $this->arrive->station : '',
            'arrival_train_number' => $this->arrive ? $this->arrive->train_number : '',
            'arrival_other_location' => $this->arrive ? $this->arrive->other_location : '',

            'arrival_date' => $this->arrive ? $this->arrive->date : '',
            'arrival_hotel' => $this->arrive ? $this->arrive->hotel : '',
            'arrival_address' => $this->arrive ? $this->arrive->address : '',
            'arrival_transfer' => (bool)$this->arrive,

            'departure_id' => $this->departure ? new TransportationResource($this->departure) : '',
            'departure_type' => $this->departure ? $this->departure->type : '',
            'departure_airport' => $this->departure ? $this->departure->airport : '',
            'departure_terminal' => $this->departure ? $this->departure->terminal : '',
            'departure_airline' => $this->departure ? $this->departure->airline : '',
            'departure_flight_number' => $this->departure ? $this->departure->flight_number : '',
            'departure_station' => $this->departure ? $this->departure->station : '',
            'departure_train_number' => $this->departure ? $this->departure->train_number : '',
            'departure_other_location' => $this->departure ? $this->departure->other_location : '',
            'departure_date' => $this->departure ? $this->departure->date : '',
            'departure_hotel' => $this->departure ? $this->departure->hotel : '',
            'departure_address' => $this->departure ? $this->departure->address : '',
            'departure_transfer' => (bool)$this->departure,
            'allergies' => $this->allergies,
            'special_needs' => $this->special_needs,
        ];
    }
    /**
     * @param $entities
     * @return array
     */
    public static function arrayCollection($entities): array
    {
        $output = [];
        foreach ($entities as $entity) {
            $output[] = (new self($entity))->toArray($entity);
        }

        return $output;
    }
}
