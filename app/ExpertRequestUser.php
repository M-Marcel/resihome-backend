<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpertRequestUser extends Model
{
    protected $table = 'expert_request_user';

    protected $guarded = [];

    public function expertRequestQuestions(){
        return $this->hasMany(ExpertQuestion::class);
    }

}
