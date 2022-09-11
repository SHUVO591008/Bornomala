<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\user_social;
use App\Model\teacher_qualification;
Use \Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;


class UserController extends Controller
{
    

        
     public function __construct()
    {
       $this->middleware('auth:webadmin');
    }


    public function list()
    {

        return view('Backend.User.UserList');
    }

     public function view(Request $request,$id)
    {
        $decryptedID = Crypt::decrypt($request->id);

        $data = User::where('id',$decryptedID)->first();

        return view('Backend.User.UserView',compact('data'));
    }


    public function Useradd()
    {
        return view('Backend.User.UserAdd');
    }


   


    public function store(Request $request)
    {
        $unique_id = "B".mt_rand(1000, 9999);

        if(\Request::isMethod('post')){

            if($request->email){
                $this->validate($request, [
                    'email'=> 'email|unique:users,email',
                ]);

            }
            $this->validate($request, [
                    'username' =>  'required|min:5|unique:users,user_name',
                    'firstName' =>  'required',
                    'lastName' =>  'required',
                    'phone' =>  ['required','numeric','min:11','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
                    'gender'=> 'required|in:male,female,other',
                    'religion' =>'required|in:hinduism,islam,buddhists,christianity',
                    'dob' => 'required|date_format:d/m/Y',
                    'city' => 'required|in:bangladesh',
                    'address1' =>'required|max:255',
                    'address2' =>'required|max:255',
                    'role' =>'required|in:admin,teacher,student',
                    'status'=>'required|in:active,inactive',
                    'password' => 'min:6',
                    'cpassword' => 'required_with:password|same:password|min:6',

                    'image' =>'required|image',
                    'socialicon.*' => 'required|in:facebook,twitter,linkedIn,instagram|distinct',
                    'socialUrl.*'=> 'required|url',
                    'institute_name.*'=>'required',
                    'subject.*'=>'required',
                    'qualification.*'=>'required',

                ]);

           try {

                // social item advace validate
                $socialicon = $request->socialicon;
                $socialUrl = $request->socialUrl;

                foreach($socialicon as $key=>$value){
                    if(empty($value)){
                        return redirect()->back()->with('msg', 'Please select social Item.');
                    }
                }

                foreach($socialUrl as $key=>$value){
                    if(empty($value)){
                        return redirect()->back()->with('msg', 'Please type social url.');
                    }
                }


                if(empty($socialicon)){
                    return redirect()->back()->with('msg', 'Please select social Item.');
                }

                if(empty($socialUrl)){
                    return redirect()->back()->with('msg', 'Please type social url.');
                }


                if(count($request->socialUrl)!==count($request->socialicon)){
                    return redirect()->back()->with('msg', 'You help us with the right information.');
                }

                // role item advance validate
                if($request->role=='teacher'){

                    $institute_name = $request->institute_name;
                    $subject = $request->subject;
                    $qualification = $request->qualification;

                    foreach($institute_name as $key=>$value){
                        if(empty($value)){
                            return redirect()->back()->with('msg', 'Please type Institute name.');
                        }
                    }

                    foreach($subject as $key=>$value){
                        if(empty($value)){
                            return redirect()->back()->with('msg', 'Please type Subject name.');
                        }
                    }

                    foreach($qualification as $key=>$value){
                        if(empty($value)){
                            return redirect()->back()->with('msg', 'Please type Qualification/GPA.');
                        }
                    }


                    if(empty($institute_name)){
                        return redirect()->back()->with('msg', 'Please type Institute name.');
                    }

                    if(empty($subject)){
                        return redirect()->back()->with('msg', 'Please type Subject name.');
                    }

                    if(empty($qualification)){
                        return redirect()->back()->with('msg', 'Please type Qualification/GPA.');
                    }


                    if(count($institute_name)==count($subject)){

                        if(count($subject)!==count($qualification)){
                            return redirect()->back()->with('msg', 'The Institute name,Subject,Qualification field is required');
                        }
                    }else{
                        return redirect()->back()->with('msg', 'The Institute name,Subject,Qualification field is required');
                    }


                }


                   $data = new User();
                   $data->unique_id = $unique_id.Carbon::now()->second;
                   $data->user_name = $request->username;
                   $data->first_name = $request->firstName;
                   $data->last_name = $request->lastName;
                   $data->gender = $request->gender;
                   $data->religion = $request->religion;
                   $data->email = $request->email;
                   $data->dob =  \Carbon\Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
                   $data->city = $request->city;
                   $data->address_1 = $request->address1;
                   $data->address_2 = $request->address2;
                   $data->Fname = $request->Fname;
                   $data->Mname = $request->Mname;
                   $data->role = $request->role;
                   $data->status = $request->status;
                   $data->password =\Hash::make($request->password);

                    $image =$request->file('image');
                    $img_name = rand();
                    $text =strtolower($image->getClientOriginalExtension());
                    $img_full_name = $img_name.'.'.$text;
                    $upld_path ='Backend/User_image/';
                    $img_url =$upld_path. $img_full_name;
                    $success =$image->move($upld_path,$img_full_name);

                   $data->image = $img_url;
                   $data->save();



                   foreach($request->socialicon as $item=>$v){
                     $data1 = new user_social();
                     $data1->user_id= $data->id;
                     $data1->socialicon = $request->socialicon[$item];
                     $data1->socialUrl = $request->socialUrl[$item];
                     $data1->save();

                   }
     
                    if($request->role=='teacher'){
                       foreach($request->institute_name as $item=>$v){
                         $data2 = new teacher_qualification();
                         $data2->user_id= $data->id;
                         $data2->subject = $request->subject[$item];
                         $data2->institute_name = $request->institute_name[$item];
                         $data2->qualification = $request->qualification[$item];
                         $data2->save();

                       }
                    }

                   toastr()->success('Data Created Successfully.');
                   return redirect()->back();


            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps!Something went wrong');
            return redirect()->back();

        }






    }


}
