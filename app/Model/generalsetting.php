<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class generalsetting extends Model
{
   protected $guarded = [];

    public function createduser(){
        return $this->belongsTo('App\User','created_by');
    }

     public function updateuser(){
        return $this->belongsTo('App\User','updated_by');
    }

    public function position(){

        return $this->belongsTo('App\Model\HeaderTopPosition','id','gen_id')->orderBy('sl','asc')->where('position','left');
    }

    



}
