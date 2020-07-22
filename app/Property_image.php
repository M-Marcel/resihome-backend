<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_image extends Model
{

    protected $table = 'property_image';
    protected $guarded = [];

    public function property(){
        return $this->belongsTo(\App\Property::class);
    }
}
