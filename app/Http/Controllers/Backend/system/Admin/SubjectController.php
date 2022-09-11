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

            // $subject=DB::table('subjects')
            //     ->join('classes','subjects.class_id','classes.id')
            //     ->join('sections','subjects.section_id','sections.id')
            //     ->select('classes.class','sections.section','subjects.*')
            //     ->orderBy('class_id')
            //     ->get();
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

    public function DeleteSubject($id)
    {
        $subject=DB::table('subjects')->where('id',$id)->delete();
         if ($subject) {
                     $notification=array(
                        'messege'=>'Successfully Deleted',
                        'alert-type'=>'success'
                         );
                     return Redirect()->route('all.subject')->with($notification); 
                 }else{
                    $notification=array(
                        'messege'=>'Something Went Wrong!',
                        'alert-type'=>'error'
                         );
                    return Redirect()->back()->with($notification);
             }  
    }

    public function EditSubject($id)
    {
         $subject=DB::table('subjects')->where('id',$id)->first();
         return view('admin.subject.edit_subject',compact('subject'));
    }
    public function UpdateSubject(Request $request,$id)
    {
        $request->validate([
        'class_id' => 'required',
        'subject_name' => 'required',
        ],
        [
            'class_id.required' => 'Please Select Class  !',
            'subject_name.required' => 'Write Subject name !',
        ]);

        $data=array();
        $data['class_id']=$request->class_id;
        $data['subject_name']=$request->subject_name;
        $data['subject_code']=$request->subject_code;
        $subject=DB::table('subjects')->where('id',$id)->update($data);
         if ($subject) {
                     $notification=array(
                        'messege'=>'Successfully Updated',
                        'alert-type'=>'success'
                         );
                     return Redirect()->route('all.subject')->with($notification); 
                 }else{
                    $notification=array(
                        'messege'=>'Nothing to update',
                        'alert-type'=>'error'
                         );
                    return Redirect()->route('all.subject')->with($notification);
             }  
    }

 //Exams routes are here-----
    public function AllExam()
    {
        $exam=DB::table('exams')->get();
        return view('admin.class.all_exam',compact('exam'));
    }

    public function InsertExam(Request $request)
    {
        $request->validate([

        'exam_name' => 'required|unique:exams|max:100',
        ],
        [
            'exam_name.required' => 'Write Exam Name!',
           
        ]);

        $data=array();
        $data['exam_name']=$request->exam_name;
        $exam=DB::table('exams')->insert($data);
        if ($exam) {
                     $notification=array(
                        'messege'=>'Successfully Inserted',
                        'alert-type'=>'success'
                         );
                     return Redirect()->back()->with($notification); 
                 }else{
                    $notification=array(
                        'messege'=>'Nothing to Insert',
                        'alert-type'=>'error'
                         );
                    return Redirect()->back()->with($notification);
             }  
    }

    public function DeleteExam($id)
    {
        $exam=DB::table('exams')->where('id',$id)->delete();
        if ($exam) {
                    $notification=array(
                        'messege'=>'Successfully Deleted',
                        'alert-type'=>'success'
                         );
                    return Redirect()->back()->with($notification); 
                 }else{
                    $notification=array(
                        'messege'=>'Nothing to Insert',
                        'alert-type'=>'error'
                         );
                    return Redirect()->back()->with($notification);
             }  
    }

    public function EditExam($id)
    {
         $exam=DB::table('exams')->where('id',$id)->first();
         return view('admin.class.edit_exam',compact('exam'));
    }

    public function UpdateExam(Request $request ,$id)
    {
        $data=array();
        $data['exam_name']=$request->exam_name;
        $exam=DB::table('exams')->where('id',$id)->update($data);
        if ($exam) {
                     $notification=array(
                        'messege'=>'Successfully Inserted',
                        'alert-type'=>'success'
                         );
                     return Redirect()->route('all.exam')->with($notification); 
                 }else{
                    $notification=array(
                        'messege'=>'Nothing to Insert',
                        'alert-type'=>'error'
                         );
                    return Redirect()->route('all.exam')->with($notification);
             }  
    }




}
