<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HeaderTopPosition extends Model
{
    protected $guarded = [];

   public function headerModelposition(){

        return $this->belongsTo('App\Model\generalsetting','gen_id');
    }

    public function socialModelposition(){

        return $this->belongsTo('App\Model\socialSettings','gen_id');
    }
}
