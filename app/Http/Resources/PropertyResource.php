<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Property;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //     'data' => parent::toArray($request),
        //     // 'image' => Property::with('propertyImages')->;


        // ];

        return parent::toArray($request);
    }
}
