<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

class CourseController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:webadmin');
    }


 public function AllCourse()
    {
        $course=DB::table('courses')
                ->join('classes','courses.class_id','classes.id')
                ->join('years','courses.session_id','years.id')
                ->select('classes.class','years.year','courses.*')
                ->groupBy('courses.class_id')
                ->groupBy('courses.session_id')
                ->orderBy('courses.class_id','desc')
                ->paginate(5);
        return view('Backend.system.course.all_courses',compact('course'));
   
    }


    public function getSectionName(Request $request){

         if($request->ajax()){

            $decryptedID = Crypt::decrypt($request->class_id);

            $allData = DB::table('sections')->where('class_id',$decryptedID)->get();



            return response()->json($allData);

          }else{
             toastr()->error('Opps!Something went wrong');
            return redirect()->back();
         }
    }



    public function InsertCourse(Request $request)
    {


        if(\Request::isMethod('post')){

        $request->validate([
        'class_id' => 'required',
        'section_id' => 'required',
        'session_id' => 'required',
        'course_name.*' => 'required',
        'course_fee.*' => 'required|numeric',
        'course_type.*' => 'required|in:monthly,daily,yearly',
        'status.*' => 'required|in:active,inactive',


        ],
        [
            'class_id.required' => 'Please Select Class  !',
             'section_id.required' => 'Please Select Section  !',
            'subject_name.required' => 'Write Subject name !',
        ]);


        try{

            $class_id = Crypt::decrypt($request->class_id);
            $session_id = Crypt::decrypt($request->session_id);

             $Clascheck = DB::table('classes')->where('id',$class_id)->first();
             $Sectioncheck = DB::table('sections')->where('id',$request->section_id)->first();
             $Sessioncheck = DB::table('years')->where('id',$session_id)->first();

                if(is_null($Clascheck)){
                    toastr()->error('Please not try again.');
                    return redirect()->back();
                }

                 if(is_null($Sectioncheck)){
                    toastr()->error('Please not try again.');
                    return redirect()->back();
                }

                if(is_null($Sessioncheck)){
                    toastr()->error('Please not try again.');
                    return redirect()->back();
                }

              foreach($request->course_name as $item=>$v){

                $data=array();
                $data['class_id']=$class_id;
                $data['section_id']=$request->section_id;
                $data['session_id']=$session_id;
                $data['course_name']=$request->course_name[$item];
                $data['course_fee']=$request->course_fee[$item];
                $data['course_type']=$request->course_type[$item];
                $data['status']=($request->status[$item]=='active')?'1':'0';
                $data['created_by']= Auth()->user()->id;
                $course=DB::table('courses')->insert($data);


               }


            toastr()->success('Data Created Successfully.');
            return redirect()->route('all.course');


        }catch (\Exception $e) {
            toastr()->error('Opps!Something went wrong');
            return redirect()->back();
        }


        }else{

            toastr()->error('Opps!Something went wrong');
            return redirect()->back();

        }



    }


    public function status(Request $request)
    {

        if($request->isMethod('post')){

            $decryptedID = Crypt::decrypt($request->dataId);

            $check = DB::table('courses')->where('id',$decryptedID)->first();

            if(is_null($check)){
               return response()->json(['check'=>'Sorry!Please not try again.']);
            }

    
            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

            $data=array();
            $data['status']=$status;
            $data['updated_by']=Auth()->user()->id;
            $courses=DB::table('courses')->where('id',$decryptedID)->update($data);

            return response()->json(['msg'=>'Data Updated Successfully.']);

        }
    }



    public function DeleteCourse(Request $request,$id)
    {
         if($request->isMethod('get')){

            try{
            
                $id = Crypt::decrypt($request->id);

                $DataDelete = DB::table('courses')->where('id',$id)->delete();

                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('all.course');

            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps!Something went wrong.');
            return redirect()->back();
        }
    }

    public function EditCourse(Request $request)
    {
         $sl = 0;

         //id decrypt
         $decryptedID = Crypt::decrypt($request->val);

         $courses=DB::table('courses')->where('id',$decryptedID)->first();


          $class=DB::table('classes')
                ->join('sections','classes.id','sections.class_id')
                ->groupBy('sections.class_id')
                ->select('classes.*')
                ->get();

        $section= DB::table('sections')->where('class_id',$courses->class_id)->get();
        $year= DB::table('years')->get();

        $coursesTest = DB::table('courses')->where('id',$decryptedID)->get();



         $html = '<div class="row">
                    <script>
                        $(".select3").select2({
                            dropdownAutoWidth: true,
                             width: "100%"
                        });

                    </script>

                     <input id="hiddenID" name="hiddenID" type="hidden" value="'.Crypt::encrypt($courses->id).'"  class="validate" data-error=".hiddenID" required="">


                        <div class="input-field col m12 s12">
                         <select onchange="myFunctionEdit(this)" class="select3 browser-default validate" name="class_id" id="class_idEdit" data-error=".class_idEdit" required="">
                            <option value="" selected>Select Class</option>';

                              foreach ($class as $key) {

                                    $selected = ($key->id == $courses->class_id)?"selected":"";

                                    $html .='<option '.$selected.' value="'.Crypt::encrypt($key->id).'">'.$key->class.'</option>';
                                    

                                }; 

        $html.= '</select>

                           <small class="class_id30"></small>
                        </div>

                        <div class="input-field col m6 s6">
                            <select class="select3 browser-default validate" name="section_id" id="section_idEdit" data-error=".section_idEdit30" required="">
                                <option value="" selected="" disabled="">Select Section</option>';

                                    foreach ($section as $key) {

                                        $selected = ($key->id == $courses->section_id)?"selected":"";

                                        $html .='<option '.$selected.' value="'.$key->id.'">'.$key->section.'</option>';  

                                    }; 

        $html.='</select>

                           <small class="section_idEdit30"></small>
                        </div>


                         <div class="input-field col m6 s6">
                            <select class="select3 browser-default validate" name="session_id" id="session_idEdit" data-error=".session_id30" required="">
                                <option value="" selected disabled="">Select Year</option>';

                                 foreach ($year as $key) {

                                        $selected = ($key->id == $courses->session_id)?"selected":"";

                                        $html .='<option '.$selected.' value="'.Crypt::encrypt($key->id).'">'.$key->year.'</option>';  

                                    }; 
                           
        $html.= '</select>

                           <small class="session_id30"></small>
                        </div>
                    </div>
                    <div class="editRowcourse" id="editRowcourse">';

                    foreach ($coursesTest as $key) {
                        $sl++;
                        $monthly = ($key->course_type=="monthly")?"selected":"";
                        $daily = ($key->course_type=="daily")?"selected":"";
                        $yearly = ($key->course_type=="yearly")?"selected":"";

                        $active = ($key->status==1)?"selected":"";
                        $inactive = ($key->status==0)?"selected":"";

                        $html.='<div id="delete_Edit_more_item" class="delete_Edit_more_item">
                        <div id="courseDiv" class="row">
                             <div class="input-field col m3 s3">
                                <label class="active" for="course_name0">Course Name: <span class="red-text">*</span></label>
                                <input id="course_name0" name="course_name[]" type="text" value="'.$key->course_name.'"  class="validate" data-error=".errorcourse_name1'.$sl.'" required="">
                                <small class="errorcourse_name1'.$sl.'"></small>
                               
                            </div>

                            <div class="input-field col m3 s3">
                                <label class="active" for="course_fee0">Course Fee: <span class="red-text">*</span></label>
                                <input id="course_fee0" name="course_fee[]" type="text" value="'.$key->course_fee.'" class="validate" data-error=".errorcourse_fee1'.$sl.'" required="">
                                <small class="errorcourse_fee1'.$sl.'"></small>
                            </div>


                            <div class="input-field col m2 s2">
                                <select class="select3 browser-default validate" name="course_type[]" id="course_type0" data-error=".errorcourse_type'.$sl.'" required="">

                           

                                <option  value="" selected="" disabled="">Select Course Type</option>
                                <option '.$monthly.' value="monthly">Monthly</option>
                                <option '.$daily.' value="daily">Daily</option>
                                <option '.$yearly.' value="yearly">Yearly</option>

                                </select>
                             
                                <small class="errorcourse_type'.$sl.'"></small>
                            </div>


                            <div class="input-field col m2 s2">
                                <select class="select3 browser-default validate" name="status[]" id="status0" data-error=".errorStatus'.$sl.'" required="">

                                <option  value="" selected="" disabled="">Select Status</option>
                                <option '.$active.' value="active">Active</option>

                                <option '.$inactive.' value="inactive">Inactive</option>

                                </select>

                                <small class="errorStatus'.$sl.'"></small>
                            </div>

                            <div class="input-field col m2 s2">

                                <div id="courseedit" class="btn-light btn courseedit"><i class="fas fa-plus-circle"></i></div>

                                <div class="red btn courseEditremove"><i class="fas fa-minus-circle"></i></div>
                            </div>

                        </div>
                        </div>';
                    }

        $html.='</div>';

        return response()->json(@$html);
    }

    public function UpdateCourse(Request $request)
    {
        if(\Request::isMethod('post')){


         $request->validate([
            'hiddenID' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'session_id' => 'required',
            'course_name.*' => 'required',
            'course_fee.*' => 'required|numeric',
            'course_type.*' => 'required|in:monthly,daily,yearly',
            'status.*' => 'required|in:active,inactive',


            ],
            [
                'class_id.required' => 'Please Select Class  !',
                 'section_id.required' => 'Please Select Section  !',
                'subject_name.required' => 'Write Subject name !',
        ]);



        $hiddenID = Crypt::decrypt($request->hiddenID);
        $class_id = Crypt::decrypt($request->class_id);
        $session_id = Crypt::decrypt($request->session_id);



        //Data Check
        $classcheck = DB::table('classes')->where('id',$class_id)->first();
        $Sectioncheck = DB::table('sections')->where('id',$request->section_id)->first();
        $Sessioncheck = DB::table('years')->where('id',$session_id)->first();


        if(is_null($classcheck)){
            toastr()->error('Please not try again.');
            return redirect()->back();
        }

         if(is_null($Sectioncheck)){
            toastr()->error('Please not try again.');
            return redirect()->back();
        }

         if(is_null($Sessioncheck)){
            toastr()->error('Please not try again.');
            return redirect()->back();
        }

         $DataDelete = DB::table('courses')->where('id',$hiddenID)->delete();

      

       foreach($request->course_name as $item=>$v){

            $data=array();
            $data['class_id']=$class_id;
            $data['section_id']=$request->section_id;
            $data['session_id']=$session_id;
            $data['course_name']=$request->course_name[$item];
            $data['course_fee']=$request->course_fee[$item];
            $data['course_type']=$request->course_type[$item];
            $data['status']=($request->status[$item]=='active')?'1':'0';
            $data['updated_by']= Auth()->user()->id;
            $course=DB::table('courses')->insert($data);


        }

             toastr()->success('Data Update Successfully.');
             return redirect()->route('all.course');

            }else{
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }

    }

 
}
