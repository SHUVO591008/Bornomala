<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

class ExamController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:webadmin');
    }

    public function AllExam()
    {
        $exam=DB::table('exams')->get();
        return view('Backend.system.exam.all_exam',compact('exam'));
    }


    public function varifyname(Request $request)
    {
        if($request->ajax()){

            $name = DB::table('exams')->where('exam_name', $request->exam_name)->get();

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

            $name = DB::table('exams')->where('exam_name', $request->exam_name)->whereNotIn('id',[$decryptedID])->get();

            if (count($name) > 0) {
                echo 'false';
            }else{
               echo 'true';

            }
        }else{
            return response()->json(['check'=>'Sorry!Please not try again.']);
            
         }

    }



    public function InsertExam(Request $request)
    {
        if(\Request::isMethod('post')){

            $request->validate([

            'exam_name' => 'required|unique:exams|max:100',
            'status' =>'required|in:active,inactive',
            ],
            [
            'exam_name.required' => 'Write Exam Name!',
               
            ]);

        try{

            $data=array();
            $data['exam_name']=$request->exam_name;
            $data['status']=($request->status=='active')?'1':'0';
            $data['created_by']= Auth()->user()->id;
            $exam=DB::table('exams')->insert($data);

            toastr()->success('Data Created Successfully.');
            return redirect()->route('all.exam');

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

            $check = DB::table('exams')->where('id',$decryptedID)->first();

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
            $exam=DB::table('exams')->where('id',$decryptedID)->update($data);

            return response()->json(['msg'=>'Data Updated Successfully.']);

        }


    }



    public function EditExam(Request $request)
    {
        if($request->ajax()){
            //id decrypt
         $decryptedID = Crypt::decrypt($request->val);

        $exam=DB::table('exams')->where('id',$decryptedID)->first();


        if($exam->status==1){
            $active = "selected";
        }else{
            $active = "";
        }

        if($exam->status==0){
            $inactive = "selected";
        }else{
            $inactive = "";
        }


        $html = '<script>
                    $("select").formSelect();

                </script>
                <div class="input-field col m6 s6">
                        <label class="active" for="exam_name">Exam Name: <span class="red-text">*</span></label>
                        <input id="exam_name2" name="exam_name" type="text" data-error=".errorexam2"  value="'.$exam->exam_name.'"  class="validate" data-error=".errorexam2" required="">
                        <small class="errorexam2"></small>
                    </div>

                     <div class="input-field col m6 s6">
                        <select class="validate" name="status" id="status" data-error=".errorStatus1" required="">

                        <option  value="" >Select Status</option>
                        <option '.$active.' value="active">Active</option>

                        <option '.$inactive.' value="inactive">Inactive</option>

                        </select>
                        <label>Status: <span class="red-text">*</span></label>
                        <small class="errorStatus1"></small>
                        <input id="hiddenVal" name="hiddenVal" type="hidden" data-error=".errorhiddenVal" value="'.$request->val.'"  class="validate" data-error=".errorhiddenVal" required="">
                    </div>';
    

            return response()->json(@$html);

         }else{
            return response()->json(['check'=>'Sorry!Please not try again.']);
         }

        
    }

    public function UpdateExam(Request $request)
    {

        if(\Request::isMethod('post')){

           $request->validate([
              'hiddenVal' => 'required',
             ]);


            $decryptedID = Crypt::decrypt($request->hiddenVal);

            $request->validate([
            'exam_name' => 'required|max:100|unique:exams,exam_name,'.$decryptedID,
            'status' =>'required|in:active,inactive',
            ],
            [
            'exam_name.required' => 'Write Exam Name!',
               
            ]);

            try{
            
                $data=array();
                $data['exam_name']=$request->exam_name;
                $data['status']=($request->status=='active')?'1':'0';
                $data['updated_by']= Auth()->user()->id;

                $exam=DB::table('exams')->where('id',$decryptedID)->update($data);
                 if ($exam) {
                    toastr()->success('Data Update Successfully.');
                    return redirect()->route('all.exam');
                           
                }else{

                    toastr()->error('Nothing to update.');
                    return Redirect()->route('all.exam');
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


    public function DeleteExam(Request $request,$id)
    {
        if($request->isMethod('get')){

            try{
                $decrypted = Crypt::decrypt($id);
                $exam=DB::table('exams')->where('id',$decrypted)->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('all.exam');

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
