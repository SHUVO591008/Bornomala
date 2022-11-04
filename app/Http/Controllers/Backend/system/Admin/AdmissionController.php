<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
Use \Carbon\Carbon;
use DB;
use Auth;


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
                          'country'=> $request->city,
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
            ->select('classes.*','sections.*','years.*','admissions.*')
            ->orderBy('admissions.id','desc')
            ->get();


      return view('Backend.system.admission.all_admission',compact('data'));
}


public function search(Request $request)
{
     if($request->ajax()){

        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'session_id' => 'required',


            ],
            [
                'class_id.required' => 'Please Select Class  !',
                 'section_id.required' => 'Please Select Section  !',
                'session_id.required' => 'Write year name !',
        ]);



        $class_id = Crypt::decrypt($request->class_id);
        $section_id = $request->section_id;
        $session_id = Crypt::decrypt($request->session_id);

        $searchAdmission=DB::table('admissions')
                        ->join('classes','admissions.class_id','classes.id')
                        ->join('sections','admissions.section_id','sections.id')
                        ->join('years','admissions.year_id','years.id')
                        ->where('admissions.class_id',$class_id)
                        ->where('admissions.section_id',$section_id)
                        ->where('admissions.year_id',$session_id)
                         ->select('classes.*','sections.*','years.*','admissions.*')
                        ->get();
    
                     


    //test
    if(count($searchAdmission)==0){
        $arr = array('msg' => 'Data Not Found!', 'status' =>false);
        return response()->json($arr);
    }else{


    $html['thsource'] = '<th>SL</th>';
    $html['thsource'] .= '<th>User Name</th>';
    $html['thsource'] .= '<th>Name</th>';
    $html['thsource'] .= '<th>Email/Phone</th>';
    $html['thsource'] .= '<th>Gender</th>';
    $html['thsource'] .= '<th>Class</th>';
    $html['thsource'] .= '<th>Section</th>';
    $html['thsource'] .= '<th>Year</th>';
    $html['thsource'] .= '<th>Age</th>';
    $html['thsource'] .= '<th>Admission Date</th>';
    $html['thsource'] .= '<th>Status</th>';
    $html['thsource'] .= '<th>Action</th>';


    foreach ($searchAdmission as $key => $v) {

        $prodID= Crypt::encrypt($v->id); 
        $selected = ($v->status==1)?"checked":"";
     
        $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';

   

        $html[$key]['tdsource'] .= '<td>
                                        <h2 class="table-avatar">
                                            <a class="avatar" href="">
                                                <img class="" src="'.asset($v->student_image).'">
                                            </a>
                                            <a href=""> 
                                                '.$v->user_name.'
                                                <span>'.$v->student_id.'</span>
                                            </a>
                                        </h2>
                                    </td>';
        $html[$key]['tdsource'] .= '<td>'.$v->first_name.'</td>';

        $html[$key]['tdsource'] .= '<td>'.$v->email.'
                                        <span style="display:block">SM:'.$v->mobile.'</span>
                                        <span style="display:block">GM:'.$v->gurdian_mobile.'</span>
                                    </td>';
        $html[$key]['tdsource'] .= '<td>'.$v->gender.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$v->class.'</td>';  
        $html[$key]['tdsource'] .= '<td>'.$v->section.'</td>';  
        $html[$key]['tdsource'] .= '<td>'.$v->year.'</td>';  
        $html[$key]['tdsource'] .= '<td>'.\Carbon\Carbon::parse($v->dob)->age.'Years </td>';
        $html[$key]['tdsource'] .= '<td>'.\Carbon\Carbon::parse($v->admission_date)->format("d-m-Y").'</td>';                                
       

        $html[$key]['tdsource'] .= '<td>';
        $html[$key]['tdsource'] .= '<div class="switch">
            <label>
              <span>Inactive</span>
            <input data-column="'.route("course.status").'" class="status course" data-id="'.$prodID.'" id="status'.($key+1).'" 
               '.$selected.' type="checkbox">
              <span class="lever"></span>
              <span>Active</span>
            </label>
        </div>';

        $html[$key]['tdsource'] .= '</td>';



        $html[$key]['tdsource'] .= '<td>';
        $html[$key]['tdsource'] .= '<a id="editCourse" data-id="'.$prodID.'" class="btn-floating waves-effect waves-light amber darken-4 mr-5 modal-trigger editCourse" title="Edit"  href="#modal3"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a> 

         <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="'.route("course.delete",$prodID).'" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>';


        $html[$key]['tdsource'] .= '</td>';


    }

    // script(status and sweet-alert)
    $html['script'] ='<script>
    $(document).ready(function() {

    $(".status").on("click", function() {
    var link = $(this).attr("data-column");
    var dataId = $(this).attr("data-id");
    var check = $(this).val($(this).is(":checked"));
    var val = $(this).val();

    toastr.options = {
        "closeButton": false,
        "debug": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $.ajax({
        url: link,
        type: "post",
        data: {
            dataId: dataId,
            val: val,
        },
        dataType: "json",
        success: function(result) {

            if(result.check){
                toastr.error(result.check);
            }else{
                toastr.success("Data Updated Successfully.");
            }

        },
        error: function(erro) {
            toastr.error("Data Not Updated.");

        },
    });


    });



$(".delete-confirm").click(function(e){
    e.preventDefault();
    var link =$(this).attr("href");
    swal({ 
        title: "Are you sure?",   
        text: "You will not be able to recover this imaginary file!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }, function(isConfirm){   
        if (isConfirm) {    
            swal("Deleted!", "Your imaginary file has been deleted.", "success");   
            window.location.href = link;
        } else {     
            swal("Cancelled", "Your imaginary file is safe :)", "error");   
        } 
    });


});
});
</script>';
// script End

    return response()->json(@$html);


    }

     }else{
        toastr()->error('Opps!Something went wrong.');
        return redirect()->back();
     }





}

public function status(Request $request)
{

    if($request->isMethod('post')){

        $decryptedID = Crypt::decrypt($request->dataId);
        $check = DB::table('admissions')->where('id',$decryptedID)->first();

        if(is_null($check)){
           return response()->json(['check'=>'Sorry!Please not try again.']);
        }


        if($request->val=="true"){
             $status ='active';
        }else{
            $status='inactive';
        }

        $data=array();
        $data['status']=$status;

        $courses=DB::table('admissions')->where('id',$decryptedID)->update($data);

        return response()->json(['msg'=>'Data Updated Successfully.']);

    }
}


public function edit($id){

    $decryptedID = Crypt::decrypt($id);

    $allData=DB::table('admissions')->where('id',$decryptedID)->first();
    $social=DB::table('admission_socials')->where('admission_id',$decryptedID)->get();

   

    return view('Backend.system.admission.edit_admission',compact('allData','social'));

}


public function UpdateAdmission(Request $request,$id)
    {
       

        
        if(\Request::isMethod('post')){
           

           $this->validate($request, [
              'firstName' =>  'required',
              'lastName' =>  'required',
              'admission_date' =>'required|date_format:d/m/Y',
              'phone' =>  ['required','numeric','min:11','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
              'gender'=> 'required|in:male,female,other',
              'religion' =>'required|in:hinduism,islam,buddhists,christianity',
              'dob' => 'nullable|date_format:d/m/Y',
              'image' =>'nullable|image',
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
              'gurdian_image'=>'nullable|image',
              'city' => 'required|in:bangladesh',
              'address1' =>'required|max:255',
              'address2' =>'required|max:255',
              'school_collage' =>'required|max:255',
              'school_collage_class' =>'required|max:255',
              'status'=>'required|in:active,inactive',
              'socialicon.*'=>  'nullable|required_with:socialUrl.*|in:facebook,twitter,linkedIn,instagram|distinct',
              'socialUrl.*'=> 'nullable|required_with:socialicon.*|url|distinct',
              'discount'=>'nullable|numeric|lte:100',
              'blood_group'=>'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
          ]);


          try {

          $decryptedID = Crypt::decrypt($id);
          $class_id = Crypt::decrypt($request->class_id);
          $year_id = Crypt::decrypt($request->year_id);

       
          $fee = DB::table('classes')->where('id',$class_id)->first();

          $img_path = DB::table('admissions')->where('id',$decryptedID)->first();
    
            $data=array();
            $data['first_name']=$request->firstName;
            $data['last_name']=$request->lastName;
            $data['mobile']=$request->phone;
            $data['gender']=$request->gender;
            $data['present_address']=$request->address1;
            $data['permanent_address']=$request->address2;
            $data['dob']=\Carbon\Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
            $data['country']=$request->city;
            $data['class_id']=$class_id;
            $data['section_id']=$request->section_id;
            $data['year_id']=$year_id;
            $data['scholarship']=$request->scholarship;
            $data['father_name']=$request->father_name;
            $data['father_occupation']=$request->father_occupation;
            $data['mother_name']=$request->mother_name;
            $data['mother_occupation']=$request->mother_occupation;
            $data['nid_number']=$request->nid_number;
            $data['gurdian_mobile']=$request->gurdian_mobile;
            $data['school_collage']=$request->school_collage;
            $data['school_collage_class']=$request->school_collage_class;
            $data['blood_group']=$request->blood_group;
            $data['admission_fee']=$fee->admission_fees;
            $data['discount']=$request->discount;
            $data['about']=$request->about;
            $data['admission_date']= \Carbon\Carbon::createFromFormat('d/m/Y', $request->admission_date)->format('Y-m-d');
            $data['religion']=$request->religion;
            $data['status']=$request->status;
                //Student Image
                if($request->file('image')){
                
                    $image =$request->file('image');
                    $img_name = rand();
                    $text =strtolower($image->getClientOriginalExtension());
                    $img_full_name = $img_name.'.'.$text;
                    $upld_path ='Backend/Admission_image/student_image/';
                    $img_url =$upld_path. $img_full_name;
                    $success =$image->move($upld_path,$img_full_name);
                    unlink($img_path->student_image);
                $data['student_image']=$img_url;
                }

            

            //Gurdian Image
            if($request->file('gurdian_image')){
                $gurdian_image =$request->file('gurdian_image');
                $gurdian_img_name = rand();
                $gurdian_text =strtolower($gurdian_image->getClientOriginalExtension());
                $gurdian_img_full_name = $gurdian_img_name.'.'.$gurdian_text;
                $gurdian_upld_path ='Backend/Admission_image/gurdian_image/';
                $gurdian_img_url =$gurdian_upld_path. $gurdian_img_full_name;
                $success =$gurdian_image->move($gurdian_upld_path,$gurdian_img_full_name);
                unlink($img_path->gurdian_image);
            $data['gurdian_image']=$gurdian_img_url;
            }

            $data['updated_at']=Carbon::now();
   
            DB::table('admissions')
                ->where('id',$decryptedID)
                ->update($data);

                //Social data insert

          

            if(!in_array(null,$request->socialicon)){

                DB::table('admission_socials')->where('admission_id',$decryptedID)->delete();

                foreach($request->socialicon as $item=>$v){
                    

                    $data1=array();
                    $data1['admission_id']=$decryptedID;
                    $data1['socialicon']=$request->socialicon[$item];
                    $data1['socialUrl']=$request->socialUrl[$item];
                    $data1['updated_at'] = Carbon::now();
                    $done=DB::table('admission_socials')->insert($data1);
                }

            }

                toastr()->success('Data Update Successfully.');
                return redirect()->back();
        
          } catch (\Throwable $th) {
                toastr()->error('Opps!Something went wrong');
                return redirect()->back();
          }

        }else{
            toastr()->error('Opps!Something went wrong');
            return redirect()->back();

        }

    }


public function ViewAdmission($id){

        $decryptedID = Crypt::decrypt($id);

        $data=DB::table('admissions')
        ->where('admissions.id',$decryptedID)
        ->join('classes','admissions.class_id','classes.id')
        ->join('sections','admissions.section_id','sections.id')
        ->join('years','admissions.year_id','years.id')
        ->select('classes.*','sections.*','years.*','admissions.*')
        
        ->first();


    
       // $data=DB::table('admissions')->where('id',$decryptedID)->first();
        $social=DB::table('admission_socials')->where('admission_id',$decryptedID)->get();
    
       
        return view('Backend.system.admission.view_admission',compact('data','social'));
    
}
    



}
