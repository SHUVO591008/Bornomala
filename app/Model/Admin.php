<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
        use Notifiable;
   
    protected $guarded = [];

    // public function adminsocials(){
    //     return $this->hasMany('App\Model\admission_socials','admission_id');
    // }

    // public function education(){
    //     return $this->hasMany('App\Model\teacher_qualification','user_id');
    // }

    public function verifyUser(){
        return $this->hasOne('App\verifyAdmin','user_id');
    }

}
