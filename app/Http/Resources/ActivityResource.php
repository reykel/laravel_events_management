<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ActivityResource extends JsonResource
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
            'date_literal' => date_format(date_create($this->date,), "l d.m.Y"),
            'date' => date_format(date_create($this->date,), "Y-m-d"),
            'hour' => date("H:i", strtotime($this->hour)),
            'name' => $this->name,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'executives' => $this->getNames($this->executive), //several executive names
            'address' => $this->address,
            'mobile' => $this->getMobiles($this->executive),
            'comment' => $this->comment,
        ];
    }

    public function getNames($executives)
    {
        $items = '';
        foreach ($executives as $executive) {
            $items .= $executive->name . ', ';
        }
        return Str::substr($items, 0, strlen($items) - 2);
    }
    public function getMobiles($executives)
    {
        $items = '';
        foreach ($executives as $executive) {
            $items .= $executive->mobile . ', ';
        }

        return Str::substr($items, 0, strlen($items) - 2);
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
