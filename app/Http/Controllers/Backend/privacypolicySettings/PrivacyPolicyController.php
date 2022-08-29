<?php

namespace App\Http\Controllers\Backend\privacypolicySettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\privacypolicy;
 use Illuminate\Support\Facades\Crypt;

class PrivacyPolicyController extends Controller
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

        return view('Backend\PrivacyPolicy\PrivacyPolicyAdd');
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
                'text' =>'required',
            ]);
           

           try{

                $data = new privacypolicy();
                $data->text = $request->text;
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
                $data = privacypolicy::where('id',$decryptedID)->first();
                return view('Backend\PrivacyPolicy\PrivacyPolicyAdd',compact('data'));

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

            $ID = Crypt::decrypt($id);

            $this->validate($request, [ 
                'text' =>'required',
                
            ]);

           

            try{
                
             $data = privacypolicy::where('id',$ID)
                    ->update([
                        'text'=>$request->text,
                        'updated_by'=> Auth()->user()->id,
                    ]);
                

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('privacypolicy.add');

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
                $data = privacypolicy::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('privacypolicy.add');

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
