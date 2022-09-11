<?php

namespace App\Model\System;

use Illuminate\Database\Eloquent\Model;

class class extends Model
{
     protected $guarded = [];

    public function createduser(){
        return $this->belongsTo('App\Model\Admin','created_by');
    }

     public function updateuser(){
        return $this->belongsTo('App\Model\Admin','updated_by');
    }

    
}
