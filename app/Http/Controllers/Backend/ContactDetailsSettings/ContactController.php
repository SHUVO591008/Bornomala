<?php

namespace App\Http\Controllers\Backend\ContactDetailsSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\contact;
use App\Model\ContactDetails;
use App\Model\socialContact;
use Auth;
use Illuminate\Support\Facades\Crypt;
use DB;
use Location;
use App\Helpers\UserSystemInfoHelper;
use Mail;


class ContactController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function Detailsadd()
    {
         $this->middleware('auth');

        return view('Backend\ContactSettings\DetailsAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Detailsstore(Request $request)
    {
        $this->middleware('auth');
       
        if(\Request::isMethod('post')){
        
            $this->validate($request, [
                
                'title' =>'required',
                'mytextarea' =>  'required',
                'status' =>'required|in:active,inactive',
                'map' =>'required',
            ]);

            if($request->name){

                 $this->validate($request, [
                    'name.*' =>'required',
                    'socialUrl.*' => 'required|url',
                    'statussocial.*' =>'required|in:active,inactive',

                ]);

            }

            // Data Inserted Check

            $check = ContactDetails::get();


            if(count($check)>1){
                toastr()->error('Data already inserted.');
                return redirect()->back();
            }


        try{
                $data = new ContactDetails();
                $data->title = $request->title;
                $data->text = $request->mytextarea;
                $data->map = $request->map;
                $data->status = ($request->status=='active')?'1':'0';
                $data->created_by = Auth()->user()->id;
              

            if($request->name){
              foreach($request->name as $item=>$v){
                 $data1 = new socialContact();
                 $data1->name= $request->name[$item];
                 $data1->url = $request->socialUrl[$item];
                 $data1->status = ($request->statussocial[$item]=='active')?'1':'0';
                 $data1->created_by = Auth()->user()->id;
                 $data1->save();

               }
            }
                $data->save();
            
                toastr()->success('Data Created Successfully.');
                return redirect()->route('contactDetails.add');

            }catch (\Exception $e) {
                toastr()->error('Opps! Something went wrong');
                return redirect()->back();
            }


          

        }else{

            toastr()->error('Opps! Something went wrong');
            return redirect()->back();

        }
    }


    public function Detailsstatus(Request $request)
    {
        $this->middleware('auth');

        if($request->isMethod('post')){

            $decryptedID = Crypt::decrypt($request->dataId);


            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

           $data = ContactDetails::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


           
        
            return response()->json(['msg'=>'Data Updated Successfully.']);

        }


    }


    public function socialstatus(Request $request)
    {
        $this->middleware('auth');

        if($request->isMethod('post')){

            $decryptedID = Crypt::decrypt($request->dataId);

            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

           $data = socialContact::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


           
        
            return response()->json(['msg'=>'Data Updated Successfully.']);

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
        $this->middleware('auth');

        $decryptedID = Crypt::decrypt($id);

        $data = contact::where('id',$decryptedID)->first();
        if(!empty($data)){
             return view('Backend\ContactSettings\view',compact('data'));
         }else{
            return redirect()->route('contact.message');
         }

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function Detailsedit(Request $request,$id)
    {

        $this->middleware('auth');

        if($request->isMethod('get')){
            try{
                $decryptedID = Crypt::decrypt($id);
                $data = ContactDetails::where('id',$decryptedID)->first();

                 $data1 = socialContact::get();

                return view('Backend\ContactSettings\DetailsAdd',compact('data','data1'));

            }catch (\Exception $e) {
                
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
            


        }
        
    }


    public function Detailsupdate(Request $request)
    {
        $this->middleware('auth');
      
        if($request->isMethod('post')){

       

           $this->validate($request, [
                
                'title' =>'required',
                'mytextarea' =>  'required',
                'status' =>'required|in:active,inactive',
                'map' =>'required',
            ]);

            if($request->name){

                 $this->validate($request, [
                    'name.*' =>'required',
                    'socialUrl.*' => 'required|url',
                    'statussocial.*' =>'required|in:active,inactive',

                ]);

            }

           

           
                try{
               
                // Data Deleted
                  DB::table('contact_details')->delete();
                  DB::table('social_contacts')->delete();

                $data = new ContactDetails();
                $data->title = $request->title;
                $data->text = $request->mytextarea;
                $data->map = $request->map;
                $data->status = ($request->status=='active')?'1':'0';
                $data->created_by = Auth()->user()->id;
                $data->updated_by = Auth()->user()->id;

                if($request->name){
                  foreach($request->name as $item=>$v){
                     $data1 = new socialContact();
                     $data1->name= $request->name[$item];
                     $data1->url = $request->socialUrl[$item];
                     $data1->status = ($request->statussocial[$item]=='active')?'1':'0';
                     $data1->created_by = Auth()->user()->id;
                     $data1->save();
                   }
                }

                $data->save();



                toastr()->success('Data Updated Successfully.');
                return redirect()->route('contactDetails.add');

            }catch (\Exception $e) {
                toastr()->error('Opps! Something went wrong');
                return redirect()->back();
            }
            


        }
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
    public function Detailsdestroy(Request $request)
    {
        $this->middleware('auth');
        
        if($request->isMethod('get')){


            try{
                // Data Deleted
                  DB::table('contact_details')->delete();
                  DB::table('social_contacts')->delete();

               
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('contactDetails.add');

            }catch (\Exception $e) {
                toastr()->error('Opps! Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps! Something went wrong.');
            return redirect()->back();
        }

    }


     public function add()
    {
         $this->middleware('auth');

        return view('Backend\ContactSettings\message');
    }



    public function store(Request $request)
    {
        $getip = UserSystemInfoHelper::get_ip();
        //$getbrowser = UserSystemInfoHelper::get_browsers();
        $getdevice = UserSystemInfoHelper::get_device();
        //$getos = UserSystemInfoHelper::get_os();


        $ip  = Location::get('103.111.227.177');

      


       
        if(\Request::isMethod('post')){
        
            $this->validate($request, [
                
                'name' =>'required',
                'message' =>'required',
                'email' =>'required|email',
                'number' =>['required','numeric','min:11','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
            ]);

          
                try{


                    $data = array(
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'mobile'=>$request->number,
                        'text'=>$request->message,
                        'ip'=>$ip->ip,
                        'country'=>$ip->countryName,
                        'city'=>$ip->cityName,
                        'device'=>$getdevice,

                    );

                    Mail::send('Backend.ContactSettings.emialTamp', $data, function($message) use($request){
                    $message->to($request->email);
                     $username = 'Contact Message From '.$request->name;
                    $message->subject($username);
                    });

                    if (!Mail::failures()) {
                        $data = new contact();
                        $data->name= $request->name;
                        $data->email= $request->email;
                        $data->mobile= $request->number;
                        $data->text= $request->message;
                        $data->ip= $ip->ip;
                        $data->country=$ip->countryName;
                        $data->city= $ip->cityName;
                        $data->device=$getdevice;
                        $data->save();

                        toastr()->success('Message sent successfully.');
                        return redirect()->route('contact');
                    }
                  
                
            }catch (\Exception $e) {
                toastr()->error('Opps! Something went wrong.');
                return redirect()->back();
            }


        }else{

            toastr()->error('Opps! Something went wrong');
            return redirect()->back();

        }

    }


    public function destroy(Request $request,$id)
    {
        
        if($request->isMethod('get')){

            try{
                $decrypted = Crypt::decrypt($id);
                $data = contact::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('contact.message');

            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps!Something went wrong.');
            return redirect()->back();
        }

    }


}
