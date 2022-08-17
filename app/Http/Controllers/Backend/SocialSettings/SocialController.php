<?php

namespace App\Http\Controllers\Backend\SocialSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SocialShare;
use Auth;
use Illuminate\Support\Facades\Crypt;

class SocialController extends Controller
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

        return view('Backend\SocialShareSettings\SocialShareAdd');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        
       if(\Request::isMethod('post')){
        
            $this->validate($request, [
                'name.*' =>  'required|unique:social_shares,name|in:facebook,twitter,linkedin,whatsapp',
                'title' =>'required',
                'url' =>  'required|url',
                'status' =>'required|in:active,inactive',
            ],[

                'name.*.unique'=>'The name has already been taken.',

            ]);

    
           

           try{

                foreach($request->name as $item=>$v)
                {
                     
                    $data = new SocialShare();
                    $data->name = $request->name[$item];
                    $data->title = $request->title;
                    $data->url = $request->url;
                    $data->status = ($request->status=='active')?'1':'0';
                    $data->created_by = Auth()->user()->id;
                    $data->save();
                }
            
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

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
        
            try{
                $decryptedID = Crypt::decrypt($id);
                $data = SocialShare::where('id',$decryptedID)->first();
                return view('Backend\SocialShareSettings\SocialShareAdd',compact('data'));

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
                'name.*' =>  'required|in:facebook,twitter,linkedin,whatsapp|unique:social_shares,name,'.$decryptedID,
                'title' =>'required',
                'url' =>  'required|url',
                'status' =>'required|in:active,inactive',
            ]);



            try{

                foreach($request->name as $item=>$v)
                {


             $data = SocialShare::where('id',$decryptedID)
                    ->update([
                        'name'=>$request->name[$item],
                        'title'=>$request->title,
                        'url'=>$request->url,
                        'status'=>($request->status=='active')?'1':'0',
                        'updated_by'=> Auth()->user()->id,
                    ]);
                     
                  
                }




             // $data = SocialShare::where('id',$decryptedID)
             //        ->update([
             //            'name'=>implode(" ",$request->name),
             //            'title'=>$request->title,
             //            'url'=>$request->url,
             //            'status'=>($request->status=='active')?'1':'0',
             //            'updated_by'=> Auth()->user()->id,
             //        ]);

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('SocialShare.add');

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

           $data = SocialShare::where('id',$decryptedID)
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
                $data = SocialShare::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('SocialShare.add');

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
