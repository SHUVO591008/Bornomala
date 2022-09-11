<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class verifyAdmin extends Model
{
   protected $guarded = [];

    public function User(){
        return $this->belongsTo('App\Model\Admin');
    }
}
