<?php

namespace App\Http\Controllers\Backend\mailSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\mailsettings;
 use Illuminate\Support\Facades\Crypt;

class MailSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $mailsettings = mailsettings::first();

        return view('Backend\mailSetting\add',compact('mailsettings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Request::isMethod('post')){
        
            $this->validate($request, [ 
                'mail_transport' =>'required',
                'mail_host' =>'required',
                'mail_port' =>'required',
                'mail_username' =>'required',
                'mail_password' =>'required',
                'mail_encryption' =>'required',
                'mail_from' =>'required|email',
            ]);
           

           try{



                $data = new mailsettings();
                $data->mail_transport = $request->mail_transport;
                $data->mail_host = $request->mail_host;
                $data->mail_port = $request->mail_port;
                $data->mail_username = $request->mail_username;
                $data->mail_password = $request->mail_password;
                $data->mail_encryption = $request->mail_encryption;
                $data->mail_from = $request->mail_from;
                $data->save();
                
            
                toastr()->success('Data Created Successfully.');
                return redirect()->back();

            }catch (\Exception $e) {
                toastr()->error('Opps! Something went wrong');
                return redirect()->back();
            }


        
        }else{

            toastr()->error('Opps! Something went wrong');
            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->isMethod('post')){


            $this->validate($request, [ 
                'mail_transport' =>'required',
                'mail_host' =>'required',
                'mail_port' =>'required',
                'mail_username' =>'required',
                'mail_password' =>'required',
                'mail_encryption' =>'required',
                'mail_from' =>'required|email',
                
            ]);

           

            try{

                $check = mailsettings::get();

                if(!count($check)==0){

                    foreach($check as $Value){
                        mailsettings::first()->delete();
                    };
                };

                
                 $data = new mailsettings();
                $data->mail_transport = $request->mail_transport;
                $data->mail_host = $request->mail_host;
                $data->mail_port = $request->mail_port;
                $data->mail_username = $request->mail_username;
                $data->mail_password = $request->mail_password;
                $data->mail_encryption = $request->mail_encryption;
                $data->mail_from = $request->mail_from;
                $data->save();
                

                toastr()->success('Data Updated Successfully.');
              return redirect()->back();

            }catch (\Exception $e) {
                
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
            


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
