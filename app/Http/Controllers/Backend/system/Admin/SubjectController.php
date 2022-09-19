<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

class SubjectController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:webadmin');
    }


 public function AllSubject()
    {
        $subject=DB::table('subjects')
                ->join('classes','subjects.class_id','classes.id')
                ->select('classes.class','subjects.*')
                ->groupBy('subjects.class_id')
                ->orderBy('class_id')
                ->get();
        return view('Backend.system.subject.all_subject',compact('subject'));
   
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



    public function InsertSubject(Request $request)
    {

        if(\Request::isMethod('post')){

        $request->validate([
        'class_id' => 'required',
        'section_id' => 'required',
        'subject_name.*' => 'required',
        'subject_code.*' => 'required',
        ],
        [
            'class_id.required' => 'Please Select Class  !',
             'section_id.required' => 'Please Select Section  !',
            'subject_name.required' => 'Write Subject name !',
        ]);


        try{

            $class_id = Crypt::decrypt($request->class_id);

             $Clascheck = DB::table('classes')->where('id',$class_id)->first();
             $Sectioncheck = DB::table('sections')->where('id',$request->section_id)->first();

                if(is_null($Clascheck)){
                    toastr()->error('Please not try again.');
                    return redirect()->back();
                }

                 if(is_null($Sectioncheck)){
                    toastr()->error('Please not try again.');
                    return redirect()->back();
                }

              foreach($request->subject_name as $item=>$v){

                $data=array();
                $data['class_id']=$class_id;
                $data['section_id']=$request->section_id;
                $data['subject_name']=$request->subject_name[$item];
                $data['subject_code']=$request->subject_code[$item];
                $data['created_by']= Auth()->user()->id;
                $subject=DB::table('subjects')->insert($data);


               }


            toastr()->success('Data Created Successfully.');
            return redirect()->route('all.subject');


        }catch (\Exception $e) {
            toastr()->error('Opps!Something went wrong');
            return redirect()->back();
        }


        }else{

            toastr()->error('Opps!Something went wrong');
            return redirect()->back();

        }



    }

    public function DeleteSubject(Request $request,$id)
    {
         if($request->isMethod('get')){

            try{
            
                $section_id = Crypt::decrypt($request->id);


                $DataDelete = DB::table('subjects')->where('section_id',$section_id)->delete();

                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('all.subject');

            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps!Something went wrong.');
            return redirect()->back();
        }



    


    }

    public function EditSubject(Request $request)
    {
         $sl = 0;

         //id decrypt
         $decryptedID = Crypt::decrypt($request->val);

         $classSelect=DB::table('subjects')->where('section_id',$decryptedID)->first();


          $class=DB::table('classes')
                ->join('sections','classes.id','sections.class_id')
                ->groupBy('sections.class_id')
                ->select('classes.*')
                ->get();

        $section= DB::table('sections')->where('class_id',$classSelect->class_id)->get();

        $subject = DB::table('subjects')->where('section_id',$decryptedID)->get();



         $html = '<script>
                    $(".select2").select2({
                        dropdownAutoWidth: true,
                         width: "100%"
                    });



                </script>
                <div class="input-field col m12 s12">
                         <select onchange="myFunctionEdit(this)" class="select2 browser-default validate" name="class_id" id="class_idEdit" data-error=".class_idEdit" required="">
                            <option value="" selected disabled="">Select Class</option>';

                         
            foreach ($class as $key) {

                $selected = ($key->id == $classSelect->class_id)?"selected":"";

                $html .='<option '.$selected.' value="'.Crypt::encrypt($key->id).'">'.$key->class.'</option>';
                

            }; 

            $html.= '</select>

                       <small class="class_idEdit"></small>
                    </div>

                    <div class="input-field col m12 s12">
                        <select class="select2 browser-default validate" name="section_id" id="section_idEdit" data-error=".section_idEdit" required="">
                            <option value="" disabled selected>Select Section</option>';

            foreach ($section as $key) {

                $selected = ($key->id == $classSelect->section_id)?"selected":"";

                $html .='<option '.$selected.' value="'.$key->id.'">'.$key->section.'</option>';
                

            };  

            $html.='</select>

                       <small class="section_idEdit"></small>
                    </div>


                    <div class="editRowsubject" id="editRowsubject">';
                        

                foreach ($subject as $key) {
                   $sl++;


                    $html.='<div id="delete_Edit_more_item" class="delete_Edit_more_item">
                                    <div class="input-field col m5 s5">
                                    <label class="active" for="subject_name">Subject Name: <span class="red-text">*</span></label>
                                    <input id="subject_name" name="subject_name[]" type="text" data-error=".errorsubject_name00'.$sl.'"  class="validate" value="'.$key->subject_name.'" required="">
                                    <small class="errorsubject_name00'.$sl.'"></small>
                                   
                                </div>

                                <div class="input-field col m4 s4">
                                    <label class="active" for="subject_code">Subject Code: <span class="red-text">*</span></label>
                                    <input id="subject_code" name="subject_code[]" type="text" class="validate" data-error=".errorsubject_code00'.$sl.'" value="'.$key->subject_code.'" required="">
                                    <small class="errorsubject_code00'.$sl.'"></small>
                                   
                                </div>

                                <div class="input-field col m3 s3">

                                    <div id="subjectedit" class="btn-light btn subjectedit"><i class="fas fa-plus-circle"></i></div>

                                    <div class="red btn subjectEditremove"><i class="fas fa-minus-circle"></i></div>
                                   
                                </div>
                            </div>';

                };  


            




            $html.='</div>';

            return response()->json(@$html);
    }
    public function UpdateSubject(Request $request)
    {
        if(\Request::isMethod('post')){

        $request->validate([
        'class_id' => 'required',
        'section_id' => 'required',
        'subject_name.*' => 'required',
        'subject_code.*' => 'required',
        ],
        [
            'class_id.required' => 'Please Select Class  !',
             'section_id.required' => 'Please Select Section  !',
            'subject_name.required' => 'Write Subject name !',
        ]);



        $class_id = Crypt::decrypt($request->class_id);
        $section_id = $request->section_id;


        //Data Check
         $classcheck = DB::table('classes')->where('id',$class_id)->first();
         $Sectioncheck = DB::table('sections')->where('id',$section_id)->first();


        if(is_null($classcheck)){
            toastr()->error('Please not try again.');
            return redirect()->back();
        }

         if(is_null($Sectioncheck)){
            toastr()->error('Please not try again.');
            return redirect()->back();
        }

         $DataDelete = DB::table('subjects')->where('class_id',$class_id)->where('section_id',$section_id)->delete();

        foreach($request->subject_name as $item=>$v){
                $data=array();
                $data['class_id']=$class_id;
                $data['section_id']=$section_id;
                $data['subject_name']=$request->subject_name[$item];
                $data['subject_code']=$request->subject_code[$item];
                $data['updated_by']= Auth()->user()->id;
                $subject=DB::table('subjects')->insert($data);

        }

             toastr()->success('Data Update Successfully.');
             return redirect()->route('all.subject');

            }else{
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }

    }

 




}
