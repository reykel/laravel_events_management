<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'hour' => date("H:i", strtotime($this->hour)) . ' hrs',
            'name' => $this->name,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'executive' => [
                'id' => $this->executive->id,
                'name' => $this->executive->name,
            ],
            'address' => $this->address,
            'mobile' => $this->executive->mobile,
            'comment' => $this->comment,
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
