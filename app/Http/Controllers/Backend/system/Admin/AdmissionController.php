<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
Use \Carbon\Carbon;
use DB;


class AdmissionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:webadmin');
    }

     public function NewAdmission()
    {

        return view('Backend.system.admission.admission');
    }


    public function fee(Request $request){

         if($request->ajax()){

            $decryptedID = Crypt::decrypt($request->class_id);

            $fee = DB::table('classes')->where('id',$decryptedID)->first();

            return response()->json($fee);

          }else{
             toastr()->error('Opps!Something went wrong');
            return redirect()->back();
         }


    }


      public function varifyuserName(Request $request)
        {
          if($request->ajax()){

            $userName = DB::table('admissions')->where('user_name', $request->username)->get();

            if (count($userName) > 0) {
                echo 'false';
            }else{
               echo 'true';

            }

         }else{
             toastr()->error('Opps!Something went wrong');
            return redirect()->back();
         }


        }

    public function varifyemail(Request $request)
        {
         if($request->ajax()){

            $email = DB::table('admissions')->where('email', $request->email)->get();

            if (count($email) > 0) {
                echo 'false';
            }else{
               echo 'true';

            }

         }else{
             toastr()->error('Opps!Something went wrong');
            return redirect()->back();
         }


        }



public function InsertAdmission(Request $request)
    {

       if(\Request::isMethod('post')){

         $unique_id = "B".mt_rand(1000, 9999);


           $this->validate($request, [
              'username' =>  'required|min:5|unique:admissions,user_name',
              'firstName' =>  'required',
              'lastName' =>  'required',
              'admission_date' =>'required|date_format:d/m/Y',
              'phone' =>  ['required','numeric','min:11','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
              'gender'=> 'required|in:male,female,other',
              'religion' =>'required|in:hinduism,islam,buddhists,christianity',
              'dob' => 'nullable|date_format:d/m/Y',
              'image' =>'required|image',
              'class_id'=>'required',
              'section_id'=>'required',
              'year_id'=>'required',
              'scholarship'=>'required|in:full_fee,half_fee',
              'admission_fee'=>'required|numeric',
              'father_name'=>'required',
              'father_occupation'=>'required',
              'mother_name'=>'required',
              'mother_occupation'=>'required',
              'gurdian_mobile'=> ['required','numeric','min:11','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
              'nid_number'=>'required|numeric',
              'gurdian_image'=>'required|image',
              'city' => 'required|in:bangladesh',
              'address1' =>'required|max:255',
              'address2' =>'required|max:255',
              'school_collage' =>'required|max:255',
              'school_collage_class' =>'required|max:255',
              'status'=>'required|in:active,inactive',
              'password' => 'min:6',
              'cpassword' => 'required_with:password|same:password|min:6',
              'socialicon.*'=>  'nullable|required_with:socialUrl.*|in:facebook,twitter,linkedIn,instagram|distinct',
              'socialUrl.*'=> 'nullable|required_with:socialicon.*|url|distinct',
              'discount'=>'nullable|numeric|lte:100',
              'blood_group'=>'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
              'email'=> 'nullable|email|unique:admissions,email',
          ]);
           try{

               $class_id = Crypt::decrypt($request->class_id);
               $year_id = Crypt::decrypt($request->year_id);

               $fee = DB::table('classes')->where('id',$class_id)->first();

                  //Student Image
                 $image =$request->file('image');
                 $img_name = rand();
                 $text =strtolower($image->getClientOriginalExtension());
                 $img_full_name = $img_name.'.'.$text;
                 $upld_path ='Backend/Admission_image/student_image/';
                 $img_url =$upld_path. $img_full_name;
                 $success =$image->move($upld_path,$img_full_name);

                  //Gurdian Image
                 $gurdian_image =$request->file('gurdian_image');
                 $gurdian_img_name = rand();
                 $gurdian_text =strtolower($gurdian_image->getClientOriginalExtension());
                 $gurdian_img_full_name = $gurdian_img_name.'.'.$gurdian_text;
                 $gurdian_upld_path ='Backend/Admission_image/gurdian_image/';
                 $gurdian_img_url =$gurdian_upld_path. $gurdian_img_full_name;
                 $success =$gurdian_image->move($gurdian_upld_path,$gurdian_img_full_name);



               $admission_id = DB::table('admissions')->insertGetId([
                          'student_id' => $unique_id.Carbon::now()->second,
                          'user_name'=> $request->username,
                          'first_name'=> $request->firstName,
                          'last_name'=> $request->lastName,
                          'email'=> $request->email,
                          'mobile'=> $request->phone,
                          'gender'=> $request->gender,
                          'present_address'=> $request->address1,
                          'permanent_address'=> $request->address2,
                          'password'=>  \Hash::make($request->password),
                          'dob'=>   \Carbon\Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d'),
                          'country'=> $request->country,
                          'class_id'=> $class_id,
                          'section_id'=> $request->section_id,
                          'year_id'=> $year_id,
                          'scholarship'=> $request->scholarship,
                          'father_name'=> $request->father_name,
                          'father_occupation'=> $request->father_occupation,
                          'mother_name'=> $request->mother_name,
                          'mother_occupation'=> $request->mother_occupation,
                          'nid_number'=> $request->nid_number,
                          'gurdian_mobile'=> $request->gurdian_mobile,
                          'school_collage'=> $request->school_collage,
                          'school_collage_class'=> $request->school_collage_class,
                          'blood_group'=> $request->blood_group,
                          'admission_fee'=> $fee->admission_fees,
                          'discount'=> $request->discount,
                          'about'=> $request->about,
                          'admission_date'=> \Carbon\Carbon::createFromFormat('d/m/Y', $request->admission_date)->format('Y-m-d'),
                          'religion'=> $request->religion,
                          'Pass_code'=> $request->password,
                          'status'=> $request->status,
                          'student_image'=>$img_url,
                          'gurdian_image'=>$gurdian_img_url,
                          'created_at' => Carbon::now(),

                     ]);

               //Social data insert

                  if(!in_array(null,$request->socialicon)){

                      foreach($request->socialicon as $item=>$v){
                           $data1=array();
                           $data1['admission_id']=$admission_id;
                           $data1['socialicon']=$request->socialicon[$item];
                           $data1['socialUrl']=$request->socialUrl[$item];
                           $data1['created_at'] = Carbon::now();
                          $done=DB::table('admission_socials')->insert($data1);

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

public function TodayAdmission()
{

    $admission=DB::table('admissions')
               ->join('classes','admissions.class_id','classes.id')
               ->join('sections','admissions.section_id','sections.id')
               ->join('years','admissions.year_id','years.id')
               ->select('classes.*','sections.*','years.*','admissions.*')
               ->whereDate('admissions.created_at',Carbon::today())
               ->get();

    return view('Backend.system.admission.today_admission',compact('admission'));
}

public function AllAdmission()
{
     $data=DB::table('admissions')
            ->join('classes','admissions.class_id','classes.id')
            ->join('sections','admissions.section_id','sections.id')
             ->join('years','admissions.year_id','years.id')
            ->select('classes.*','sections.*','admissions.*','years.*')
            ->get();

      return view('Backend.system.admission.all_admission',compact('data'));
}



}
