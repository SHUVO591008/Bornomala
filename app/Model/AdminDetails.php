<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminDetails extends Model
{
       protected $guarded = [];

    public function createduser(){
        return $this->belongsTo('App\User','created_by');
    }

     public function updateuser(){
        return $this->belongsTo('App\User','updated_by');
    }

     public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
