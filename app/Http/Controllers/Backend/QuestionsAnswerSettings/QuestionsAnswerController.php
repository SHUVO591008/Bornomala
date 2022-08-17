<?php

namespace App\Http\Controllers\Backend\QuestionsAnswerSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\qusAndans;
use Auth;
use Illuminate\Support\Facades\Crypt;

class QuestionsAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function add()
    {

        return view('Backend\QuestionsAnswerSettings\QuestionsAnswerAdd');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'qus' =>  'required',
                'ans' =>'required',
                'status' =>'required|in:active,inactive',
            ]);

           

            try{

                $data = new qusAndans();
                $data->qus = $request->qus;
                $data->ans = $request->ans;
                $data->created_by = Auth()->user()->id;
                $data->status = ($request->status=='active')?'1':'0';
                $data->save();
             

                toastr()->success('Data Created Successfully.');
                return redirect()->back();


            }catch (\Exception $e) {
                toastr()->error('Opps! Something went wrong');
                return redirect()->back();
            }

        }else{

            toastr()->error('Opps! Something went wrong');
            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $decryptedID =null;

        try{

            if($request->id){
                $decryptedID = Crypt::decrypt($request->id);

            }
            
            $data = qusAndans::get(); 

            if(empty($data)){
                abort(404);
            }

        }catch (\Exception $e) {
            return redirect()->back();
         
        }
        return view('Backend\QuestionsAnswerSettings\QuestionsAnswerView',compact('data','decryptedID'));


          
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request,$id)
    {
        
            try{
                $decryptedID = Crypt::decrypt($id);
                $data = qusAndans::where('id',$decryptedID)->first();
                return view('Backend\QuestionsAnswerSettings\QuestionsAnswerAdd',compact('data'));

            }catch (\Exception $e) {
                
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
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
                'qus' =>  'required',
                'ans' =>'required',
                'status' =>'required|in:active,inactive',
            ]);

          

            try{
                 $data = qusAndans::where('id',$decryptedID)
                        ->update([
                            'qus'=>$request->qus,
                            'ans'=>$request->ans,
                            'status'=>($request->status=='active')?'1':'0',
                            'updated_by'=> Auth()->user()->id,
                        ]);

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('QuestionsAnswer.add');

            }catch (\Exception $e) {
                
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
            


        }
    }



    public function status(Request $request)
    {

        if($request->isMethod('post')){

            $decryptedID = Crypt::decrypt($request->dataId);

            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

           $data = qusAndans::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


            $authName = Auth::user()->first_name.' '.Auth::user()->last_name;
        
            return response()->json(['msg'=>'Data Updated Successfully.','authName'=>$authName]);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy(Request $request,$id)
    {
        
       if($request->isMethod('get')){

            try{
                $decrypted = Crypt::decrypt($id);
                $data = qusAndans::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('QuestionsAnswer.add');

            }catch (\Exception $e) {
                toastr()->error('Opps! Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps! Something went wrong.');
            return redirect()->back();
        }

    }
}
