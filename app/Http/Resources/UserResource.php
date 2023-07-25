<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role->name,
            'phone' => $this->phone,
        ];
    }

    /**
     * @param $executives
     * @return string
     */
    public function getNames($executives): string
    {
        $items = '';
        foreach ($executives as $executive) {
            $items .= $executive->name . ', ';
        }
        return Str::substr($items, 0, strlen($items) - 2);
    }

    /**
     * @param $executives
     * @return string
     */
    public function getMobiles($executives): string
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
