<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class privacypolicy extends Model
{
       protected $guarded = [];

   public function createduser(){
        return $this->belongsTo('App\Model\Admin','created_by');
    }

     public function updateuser(){
        return $this->belongsTo('App\Model\Admin','updated_by');
    }
    
}
