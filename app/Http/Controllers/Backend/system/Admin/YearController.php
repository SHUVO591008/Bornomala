<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

class YearController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:webadmin');
    }

    public function AllYear()
    {
        $year=DB::table('years')->get();
        return view('Backend.system.year.year',compact('year'));
    }


    public function varifyYear(Request $request)
    {
        if($request->ajax()){

            $year = DB::table('years')->where('year', $request->year)->get();

            if (count($year) > 0) {
                echo 'false';
            }else{
               echo 'true';

            }
        }else{
              return response()->json(['check'=>'Sorry!Please not try again.']);
            
         }

    }

    public function updatevarify(Request $request)
    {
        if($request->ajax()){

            $decryptedID = Crypt::decrypt($request->id);

            $year = DB::table('years')->where('year', $request->year)->whereNotIn('id',[$decryptedID])->get();

            if (count($year) > 0) {
                echo 'false';
            }else{
               echo 'true';

            }
        }else{
            return response()->json(['check'=>'Sorry!Please not try again.']);
            
         }

    }



    public function insert(Request $request)
    {
        if(\Request::isMethod('post')){

            $request->validate([

            'year' => 'required|unique:years|numeric',
            'status' =>'required|in:active,inactive',
            ],
            [
            'year.required' => 'Write Year!',
               
            ]);

        try{

            $data=array();
            $data['year']=$request->year;
            $data['status']=($request->status=='active')?'1':'0';
            $data['created_by']= Auth()->user()->id;
            $year=DB::table('years')->insert($data);

            toastr()->success('Data Created Successfully.');
            return redirect()->route('all.year');

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

            $check = DB::table('years')->where('id',$decryptedID)->first();

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
            $years=DB::table('years')->where('id',$decryptedID)->update($data);

            return response()->json(['msg'=>'Data Updated Successfully.']);

        }


    }



    public function edit(Request $request)
    {
        if($request->ajax()){
            //id decrypt
         $decryptedID = Crypt::decrypt($request->val);

        $year=DB::table('years')->where('id',$decryptedID)->first();


        if($year->status==1){
            $active = "selected";
        }else{
            $active = "";
        }

        if($year->status==0){
            $inactive = "selected";
        }else{
            $inactive = "";
        }



        $html = '<script>
                    $("select").formSelect();

                </script>
                 <div class="input-field col m6 s6">
                        <label class="active" for="year2">Year: <span class="red-text">*</span></label>
                        <input id="year2" name="year" type="text" data-error=".erroryear2" value="'.$year->year.'" class="validate" data-error=".erroryear2" required="">
                        <small class="erroryear2"></small>
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

    public function Update(Request $request)
    {

        if(\Request::isMethod('post')){

           $request->validate([
              'hiddenVal' => 'required',
             ]);


            $decryptedID = Crypt::decrypt($request->hiddenVal);

            $request->validate([
            'year' => 'required|numeric|unique:years,year,'.$decryptedID,
            'status' =>'required|in:active,inactive',
            ],
            [
            'year.required' => 'Write Year!',
               
            ]);

            try{
            
                $data=array();
                $data['year']=$request->year;
                $data['status']=($request->status=='active')?'1':'0';
                $data['updated_by']= Auth()->user()->id;

                $year=DB::table('years')->where('id',$decryptedID)->update($data);
                 if ($year) {
                    toastr()->success('Data Update Successfully.');
                    return redirect()->route('all.year');
                           
                }else{

                    toastr()->error('Nothing to update.');
                    return Redirect()->route('all.year');
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


    public function delete(Request $request,$id)
    {
        if($request->isMethod('get')){

            try{
                $decrypted = Crypt::decrypt($id);
                $year=DB::table('years')->where('id',$decrypted)->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('all.year');

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
