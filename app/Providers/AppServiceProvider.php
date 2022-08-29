<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\mailsettings;

use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $mailsettings = mailsettings::first();
        if($mailsettings){


            $data = [
                'driver'    =>$mailsettings->mail_transport,
                'host'    =>$mailsettings->mail_host,
                'port'    =>$mailsettings->mail_port,
                'encryption'    =>$mailsettings->mail_encryption,
                'username'    =>$mailsettings->mail_username,
                'password'    =>$mailsettings->mail_password,
                'driver'    =>$mailsettings->mail_transport,
                'from'      =>[
                    'address'=>$mailsettings->mail_from,
                    'name'=>'',
                ]
            ];
            Config::set('mail',$data);

            

        }
    }
}
