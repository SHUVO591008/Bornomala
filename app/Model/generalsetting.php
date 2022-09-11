<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class generalsetting extends Model
{
   protected $guarded = [];

   public function createduser(){
        return $this->belongsTo('App\Model\Admin','created_by');
    }

     public function updateuser(){
        return $this->belongsTo('App\Model\Admin','updated_by');
    }

    public function position(){

        return $this->belongsTo('App\Model\HeaderTopPosition','id','gen_id')->orderBy('sl','asc')->where('position','left');
    }

    



}
