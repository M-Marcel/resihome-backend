<?php

namespace App\Http\Resources;
use App\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    function __construct(Property $model)
    {
        parent::__construct($model);
    }
    public function toArray($request)
    {
        // return [
        //     'data' => parent::toArray($request),
        //     'image' => $this->property->property_imagess,


        // ];
        return parent::toArray($request);
    }
}
