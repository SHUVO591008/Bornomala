<?php

namespace App\Http\Controllers\Backend\AdminDetailsSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminDetails;
use App\User;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;



class AdminDetailsController extends Controller
{
      public function __construct()
    {
       $this->middleware('auth:webadmin');
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

        return view('Backend\AdminDetailsSettings\AdminDetailsAdd');
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

        $decryptedID = Crypt::decrypt($request->user);

        $result = user::where('id',$decryptedID)->exists();

        if(!$result){
            toastr()->error('Opps! Something went wrong');
            return redirect()->back();
        }

        
            $this->validate($request, [ 
                'user' => 'required',
                'text' =>'required',
                'status' =>'required|in:active,inactive',

                
            ]);
           


           try{

    
                     
                $data = new AdminDetails();
                $data->user_id = $decryptedID ;
                $data->name = $request->name;
                $data->text = $request->text;
                $data->status = ($request->status=='active')?'1':'0';
                $data->created_by = Auth()->user()->id;
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
    public function show($id)
    {
        //
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
                $data = AdminDetails::where('id',$decryptedID)->first();
                return view('Backend\AdminDetailsSettings\AdminDetailsAdd',compact('data'));

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



           $data = AdminDetails::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


            //$authName = Auth::user()->first_name.' '.Auth::user()->last_name;
        
            return response()->json(['msg'=>'Data Updated Successfully.']);

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


          
        $decryptedID = Crypt::decrypt($request->user);

        $ID = Crypt::decrypt($id);

        $result = user::where('id',$decryptedID)->exists();

        if(!$result){
            toastr()->error('Opps! Something went wrong');
            return redirect()->back();
        }

            $this->validate($request, [ 
                'user' => 'required',
                'text' =>'required',
                'status' =>'required|in:active,inactive',
                
            ]);

           

            try{
                
             $data = AdminDetails::where('id',$ID)
                    ->update([
                        'user_id'=>$decryptedID,
                        'text'=>$request->text,
                        'name'=>$request->name,
                        'status'=>($request->status=='active')?'1':'0',
                        'updated_by'=> Auth()->user()->id,
                    ]);
                

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('admin.add');

            }catch (\Exception $e) {
                
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
            


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
                $data = AdminDetails::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('admin.add');

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
