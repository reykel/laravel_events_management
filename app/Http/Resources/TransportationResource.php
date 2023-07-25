<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransportationResource extends JsonResource
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
            'type' => $this->type,
            'airport' => $this->airport,
            'terminal' => $this->terminal,
            'airline' => $this->airline,
            'flight_number' => $this->flight_number,
            'station' => $this->station,
            'train_number' => $this->train_number,
            'other_location' => $this->other_location,
            'date' => $this->date,
            'hotel' => $this->hotel,
            'address' => $this->address,
            'transfer' => $this->transfer,
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
