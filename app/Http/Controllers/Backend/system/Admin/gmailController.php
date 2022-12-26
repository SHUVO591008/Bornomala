<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
Use \Carbon\Carbon;
use DB;
use Auth;
use Mail;
Use App\Model\System\gmail;


class gmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singlegmail($id)
    { 
        if(\Request::isMethod('get')){
    
            try {
    
                $decryptedID = Crypt::decrypt($id);
    
                $data=DB::table('admissions')
                ->where('admissions.id',$decryptedID)
                ->join('classes','admissions.class_id','classes.id')
                ->join('sections','admissions.section_id','sections.id')
                ->join('years','admissions.year_id','years.id')
                ->select('classes.*','sections.*','years.*','admissions.*')
                ->first();
    
    
    
                 return view('Backend.system.admission.singlegmail',compact('data'));
    
        
    
            } catch (\Throwable $th) {
                toastr()->error('Opps!Something went wrong');
                return redirect()->back();
            }
    
        }else{
            toastr()->error('Opps!Something went wrong');
            return redirect()->back();
    
        }
    
    
    
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
    public function store(Request $request,$id)
    {
        if(\Request::isMethod('POST')){

            $this->validate($request, [
                'mytextarea' =>  'required',
                'gmail_from'=> 'required|email',
            ]);
    
            try {

       

            $decryptedID = Crypt::decrypt($id);
                //admission data
            $admission=DB::table('admissions')->where('id',$decryptedID)->first();
                //logo
            $Settings = DB::table('settings')->first();

            //gmail Send
            $data = array(
                'text'=>$request->mytextarea,
                'name'=>$Settings->name,
            );

            Mail::send('Backend.system.gmail.singlegmailTamp', $data, function($message) use($admission,$Settings){
            $message->to($admission->email);
             $subject = $Settings->name;
            $message->subject($subject);
            });

             //insert Data   
            
            if (!Mail::failures()) {
            
                $data = new gmail();
                $data->student_id=$decryptedID;
                $data->text= $request->mytextarea;
                $data->status= 1;
                $data->created_by=Auth()->user()->id;
                $data->save();

                toastr()->success('Message sent successfully.');
                return redirect()->back();
            }
    
    
    
            } catch (\Throwable $th) {
                toastr()->error('Opps!Something went wrong');
                return redirect()->back();
            }
    
        }else{
            toastr()->error('Opps!Something went wrong');
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
    public function update(Request $request, $id)
    {
        //
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
