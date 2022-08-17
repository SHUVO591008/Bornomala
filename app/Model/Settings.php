<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
   protected $guarded = [];

     public function createduser(){
        return $this->belongsTo('App\User','created_by');
    }

     public function updateuser(){
        return $this->belongsTo('App\User','updated_by');
    }
}
