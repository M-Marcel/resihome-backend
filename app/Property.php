<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property';

    public function property_images(){
        return $this->hasMany(\App\Property_image::class);
    }
}
