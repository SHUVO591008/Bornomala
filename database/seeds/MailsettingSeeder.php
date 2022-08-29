<?php

use Illuminate\Database\Seeder;
use App\Model\mailsettings;


class MailsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $check = mailsettings::get();

        if(!count($check)==0){

            foreach($check as $Value){
                mailsettings::first()->delete();
            };
        };

        mailsettings::create([
            'mail_transport'    =>'smtp',
            'mail_host'    =>'smtp.mailtrap.io',
            'mail_port'    =>'2525',
            'mail_username'    =>'0048a8aa518a65',
            'mail_password'    =>'60f48a72e43a3a',
            'mail_encryption'    =>'tls',
            'mail_from'    =>'subratanath186@gmail.com',
        ]);
    }
}
