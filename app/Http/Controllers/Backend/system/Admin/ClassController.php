<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Model\System\section;
use DB;



class ClassController extends Controller
{
    //class methods

     public function __construct()
    {
       $this->middleware('auth:webadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ClassSection()
    {
        $class=DB::table('classes')->get();
        return view('Backend.system.class.class',compact('class'));
    }


    public function varifyname(Request $request)
    {
        if($request->ajax()){
            $name = DB::table('classes')->where('class', $request->name)->get();

            if (count($name) > 0) {
                echo 'false';
            }else{
               echo 'true';

            }
        }else{
              return response()->json(['check'=>'Sorry!Please not try again.']);
            
         }


    }



    public function updatevarifyname(Request $request)
    {
        if($request->ajax()){

            $decryptedID = Crypt::decrypt($request->id);

       

            $name = DB::table('classes')->where('class', $request->class)->whereNotIn('id',[$decryptedID])->get();

            if (count($name) > 0) {
                echo 'false';
            }else{
               echo 'true';

            }
        }else{
            return response()->json(['check'=>'Sorry!Please not try again.']);
            
         }

    }




     public function ClassInsert(Request $request)
    {

        if(\Request::isMethod('post')){

           $request->validate([
              'class' => 'required|unique:classes|max:55',
              'admission_fees' => 'required|numeric',
              'monthly_fee' => 'required|numeric',
              'exam_fee' => 'required|numeric',


             ]);

            try{


            $data=array();
            $data['class']=$request->class;
            $data['admission_fees']=$request->admission_fees;
            $data['monthly_fee']=$request->monthly_fee;
            $data['exam_fee']=$request->exam_fee;
            $data['created_by']= Auth()->user()->id;

            $class=DB::table('classes')->insert($data);

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


    public function EditClass(Request $request)
    {
        if($request->ajax()){
            //id decrypt
         $decryptedID = Crypt::decrypt($request->val);

            $class=DB::table('classes')->where('id',$decryptedID )->first();

        $html = '<div class="input-field col m12 s12">
                        <label class="active" for="class">Class Name: <span class="red-text">*</span></label>
                        <input id="classinput" name="class" type="text" data-error=".errorclass" value="'.$class->class.'"  class="validate" data-error=".errorclass" required="">
                        <small class="errorclass"></small>
                    </div>

                    <div class="input-field col m12 s12">
                        <label class="active" for="admission_fees">Admission Fee: <span class="red-text">*</span></label>
                        <input id="admission_fees" name="admission_fees" type="text" data-error=".erroradmission_fees" value="'.$class->admission_fees.'"  class="validate" data-error=".erroradmission_fees" required="">
                        <small class="erroradmission_fees"></small>
                    </div>

                    <div class="input-field col m12 s12">
                        <label class="active" for="monthly_fee">Monthly Fee: <span class="red-text">*</span></label>
                        <input id="monthly_fee" name="monthly_fee" type="text" data-error=".errormonthly_fee" value="'.$class->monthly_fee.'"  class="validate" data-error=".errormonthly_fee" required="">
                        <small class="errormonthly_fee"></small>
                    </div>

                    <div class="input-field col m12 s12">
                        <label class="active" for="exam_fee">Exam Name: <span class="red-text">*</span></label>
                        <input id="exam_fee" name="exam_fee" type="text" data-error=".errorexam_fee" value="'.$class->exam_fee.'"  class="validate" data-error=".errorexam_fee" required="">
                        <small class="errorexam_fee"></small>
                        <input id="hiddenVal" name="hiddenVal" type="hidden" data-error=".errorhiddenVal" value="'.$request->val.'"  class="validate" data-error=".errorhiddenVal" required="">
                    </div>';
    



            return response()->json(@$html);

         }else{
             toastr()->error('Opps!Something went wrong');
            return redirect()->back();
         }
         
    }



     public function UpdateClass(Request $request)
    {

        if(\Request::isMethod('post')){

           $request->validate([
              'hiddenVal' => 'required',
             ]);


            $decryptedID = Crypt::decrypt($request->hiddenVal);

           $request->validate([
              'class' => 'required|max:55|unique:classes,class,'.$decryptedID,
              'admission_fees' => 'required|numeric',
              'monthly_fee' => 'required|numeric',
              'exam_fee' => 'required|numeric',


             ]);

        try{
        

        $data=array();
        $data['class']=$request->class;
        $data['admission_fees']=$request->admission_fees;
        $data['monthly_fee']=$request->monthly_fee;
        $data['exam_fee']=$request->exam_fee;
        $data['updated_by']= Auth()->user()->id;
        $class=DB::table('classes')->where('id',$decryptedID)->update($data);
         if ($class) {
            toastr()->success('Data Update Successfully.');
            return redirect()->route('class.section');
                   
        }else{

            toastr()->error('Nothing to update.');
            return Redirect()->route('class.section');
        }  


        }catch (\Exception $e) {
            toastr()->error('Opps!Something went wrong');
            return redirect()->back();
        }



            }else{

            toastr()->error('Opps!Something went wrong');
            return redirect()->back();

        }

    }


     public function DeleteClass(Request $request,$id)
    {
     
        

        if($request->isMethod('get')){

            try{

              

                $decrypted = Crypt::decrypt($id);

                  $check = DB::table('sections')->where('class_id',$decrypted)->first();

                  if(!is_null($check)){
                    toastr()->error("Sorry!Can't be deleted now.");
                    return redirect()->back();
                  }



                $class=DB::table('classes')->where('id',$decrypted)->delete();

                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('class.section');

            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps!Something went wrong.');
            return redirect()->back();
        }
    }

     //section methods

    public function SectionPart()
    {
        $section=DB::table('sections')
                 ->join('classes','sections.class_id','classes.id')

                 ->select('sections.*','classes.class')
                 ->orderBy('sections.class_id')
                 ->groupBy('class_id')
                 ->get();

                

              
        return view('Backend.system.section.section',compact('section'));         
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


     public function SectionInsert(Request $request)
    {
         if(\Request::isMethod('post')){

        $request->validate([
        'class_id' => 'required',
        'section' => 'required',
        ],
        [
            'class_id.required' => 'Please Select Class  !',
            'section.required' => 'Write sections name !',
        ]);

        try{

        $decrypted = Crypt::decrypt($request->class_id);

        $check = DB::table('classes')->where('id',$decrypted )->first();

        if(is_null($check)){
            toastr()->error('Please not try again.');
            return redirect()->back();
        }



        for ($i=0; $i < count($request->section) ; $i++) { 

            $section = $request->section[$i];
            $DataChack  =  DB::table('sections')->where('class_id',$decrypted)->where('section',$section)->first();

            if($DataChack==null){
                $data=array();
                $data['class_id']=$decrypted;
                $data['section']=$request->section[$i];
                $data['created_by']= Auth()->user()->id;
                $sectionSave=DB::table('sections')->insert($data);
            }else{

                $findSectionId = DB::table('sections')
                    ->where('class_id',$decrypted)
                    ->pluck('id');

                $checkSubject = DB::table('subjects')
                    ->whereIn('section_id',$findSectionId)
                    ->pluck('section_id');

                DB::table('sections')
                    ->whereNotIn('id',$checkSubject)
                    ->whereIn('id',DB::table('sections')->where('class_id',$decrypted)->whereNotIn('section',$request->section)->pluck('id'))
                    ->delete();

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




    public function EditSection(Request $request)
    {
        if($request->ajax()){
            //id decrypt
         $decryptedID = Crypt::decrypt($request->val);



            $className=DB::table('sections')->where('id',$decryptedID)->first();
            $sectionName=DB::table('sections')->where('class_id',$className->class_id)->get();
            $class=DB::table('classes')->get();


        $html = '<script>
                    $(".select3").select2({
                        dropdownAutoWidth: true,
                         width: "100%"
                    });

                    $(".max-length").select2({dropdownAutoWidth:!0,
                        width:"100%",

                         tags: true,
                    tokenSeparators: [",", ""],

                    });
                </script>
                <div class="input-field col m12 s12">
                         <select onchange="getSectionName(this)" class="select3 browser-default validate" name="class_id" id="class_id1" data-error=".class_id1" required="">
                            <option value="" selected disabled> Select Class</option>';

            foreach ($class as $key) {

                $selected = ($key->id == $className->class_id)?"selected":"";

                $html .='<option '.$selected.' value="'.Crypt::encrypt($key->id).'">'.$key->class.'</option>';
                

            }; 
                          

        $html .=   '</select>
                       <small class="class_id1"></small>
                    </div>
                    <div class="input-field col m12 s12 mb-4">
                        <label>Section Name: <span class="red-text ">*</span></label>
                    </div>

                     <div class="input-field col m12 s12">
                       <select name="section[]" id="section1" data-error=".errorsection1"  class="browser-default max-length validate" multiple="multiple" required="">

                        <option disabled value="">Section name typing....</option>';


                foreach ($sectionName as $val) {

                        $html .='<option selected value="'.$val->section.'">'.$val->section.'</option>';
                    
                }; 

                
            $html .=   '</select>
                        <small class="errorsection1"></small>

                       
                    </div>';

       
    
            return response()->json(@$html);

         }else{
             toastr()->error('Opps!Something went wrong');
            return redirect()->back();
         }
         
    }


      public function UpdateSection(Request $request)
    {


        if(\Request::isMethod('post')){

     

        $request->validate([
            'class_id' => 'required',
            'section' => 'required',
            ],
            [
                'class_id.required' => 'Please Select Class  !',
                'section.required' => 'Write sections name !',
        ]);

        try{

        $class_id = Crypt::decrypt($request->class_id);

        $classcheck = DB::table('classes')->where('id',$class_id)->first();


        if(is_null($classcheck)){
            toastr()->error('Please not try again.');
            return redirect()->back();
        }




        //$DataDelete = DB::table('sections')->where('class_id',$class_id)->delete();


        for ($i=0; $i < count($request->section) ; $i++) { 

            $section = $request->section[$i];
            $DataChack  =  DB::table('sections')->where('class_id',$class_id)->where('section',$section)->first();


             if($DataChack==null){
                $data=array();
                $data['class_id']=$class_id;
                $data['section']=$request->section[$i];
                $data['updated_by']= Auth()->user()->id;
                $sectionSave=DB::table('sections')->insert($data);
            }else{

                $findSectionId = DB::table('sections')
                    ->where('class_id',$class_id)
                    ->pluck('id');

                $checkSubject = DB::table('subjects')
                    ->whereIn('section_id',$findSectionId)
                    ->pluck('section_id');

                DB::table('sections')
                    ->whereNotIn('id',$checkSubject)
                    ->whereIn('id',DB::table('sections')->where('class_id',$class_id)->whereNotIn('section',$request->section)->pluck('id'))
                    ->delete();

            }


     
        }
 
            toastr()->success('Data Update Successfully.');
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



     public function DeleteSection(Request $request,$id)
    {


        if($request->isMethod('get')){

            try{

            $decrypted = Crypt::decrypt($id);

            $findSectionId = DB::table('sections')
                ->where('class_id',$decrypted)
                ->pluck('id');

            $check = DB::table('subjects')
                ->whereIn('section_id',$findSectionId)
                ->pluck('section_id');

            
            $DataDelete = DB::table('sections')
                ->where('class_id',$decrypted)
                ->whereNotIn('id',$check)
                ->delete();

            if($DataDelete){
                toastr()->success('Data Deleted Successfully.');
            }else{
                toastr()->error('Sorry..! Could not be deleted now..');
            }

            return redirect()->route('section.part');

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
