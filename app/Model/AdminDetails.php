<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminDetails extends Model
{
       protected $guarded = [];

    public function createduser(){
        return $this->belongsTo('App\Model\Admin','created_by');
    }

     public function updateuser(){
        return $this->belongsTo('App\Model\Admin','updated_by');
    }

     public function user(){
        return $this->belongsTo('App\Model\Admin','user_id');
    }
}
