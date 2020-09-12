<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpertQuestion extends Model
{
    protected $table = 'expert_questionaire';

    protected $guarded = [];

    public function expertUser(){
        return $this->belongsToMany(ExpertRequestUser::class)->withTimestamps();
    }

}
