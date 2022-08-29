<?php

namespace App\Http\Controllers\Backend\instituteDetailsSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\instituteDetails;
 use Illuminate\Support\Facades\Crypt;

class instituteDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function add()
    {


        return view('Backend\StudyInstitute\StudyInstituteAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Request::isMethod('post')){

            $this->validate($request, [
                'title' =>  'required|max:200',
                'text' =>  'max:300',
                'status' =>'required|in:active,inactive',
            ]);

            try{

                $data = new instituteDetails();
                $data->title = $request->title;
                $data->details = $request->text;
                $data->status = ($request->status=='active')?'1':'0';
                $data->created_by = Auth()->user()->id;
                $data->save();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function status(Request $request)
    {

        if($request->isMethod('post')){

            $decryptedID = Crypt::decrypt($request->dataId);

            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

           $data = instituteDetails::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


            $authName = Auth::user()->first_name.' '.Auth::user()->last_name;
        
            return response()->json(['msg'=>'Data Updated Successfully.','authName'=>$authName]);

        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if($request->isMethod('get')){
            try{
                $decryptedID = Crypt::decrypt($id);
                $data = instituteDetails::where('id',$decryptedID)->first();
                return view('Backend\StudyInstitute\StudyInstituteAdd',compact('data'));

            }catch (\Exception $e) {
                
                toastr()->error('Opps!Something went wrong.');
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

      
        if($request->isMethod('post')){
            $decryptedID = Crypt::decrypt($id);

             $this->validate($request, [
                'title' =>  'required|max:200',
                'text' =>  'max:300',
                'status' =>'required|in:active,inactive',
            ]);

            try{
                 $data = instituteDetails::where('id',$decryptedID)
                        ->update([
                            'title'=>$request->title,
                            'details'=>$request->text,
                            'status'=>($request->status=='active')?'1':'0',
                            'updated_by'=> Auth()->user()->id,
                        ]);

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('institute.add');

            }catch (\Exception $e) {
                
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
            


        }else{
            toastr()->error('Opps!Something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        if($request->isMethod('get')){

            try{
                $decrypted = Crypt::decrypt($id);
                $data = instituteDetails::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('institute.add');

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
