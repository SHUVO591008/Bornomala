<?php


namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;




class User extends Authenticatable 
{
    use Notifiable;
    
    // implements MustVerifyEmail

    protected $guarded = [];

    public function usersocials(){
        return $this->hasMany('App\Model\user_social','user_id');
    }

    public function education(){
        return $this->hasMany('App\Model\teacher_qualification','user_id');
    }

    public function verifyUser(){
        return $this->hasOne('App\verifyUser');
    }

   
}
