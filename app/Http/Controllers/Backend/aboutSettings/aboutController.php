<?php

namespace App\Http\Controllers\Backend\aboutSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\about;
 use Illuminate\Support\Facades\Crypt;


class aboutController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function add()
    {
    

        return view('Backend\AboutSettings\aboutsettingsAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = about::get();

        if($data->isEmpty()){


       if(\Request::isMethod('post')){
            $this->validate($request, [
                'title' =>  'max:500',
                'mytextarea' =>'required',
                'image'=>'required|image',
            ]);

           

            try{

                $data = new about();
                $data->title = $request->title;
                $data->text = $request->mytextarea;
                $data->created_by = Auth()->user()->id;
                $data->status=0;

                $image =$request->file('image');
                $img_name = rand();
                $text =strtolower($image->getClientOriginalExtension());
                $img_full_name = $img_name.'.'.$text;
                $upld_path ='Backend/About_image/';
                $img_url =$upld_path. $img_full_name;
                $success =$image->move($upld_path,$img_full_name);

               $data->image = $img_url;
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


        }else{
            toastr()->error('Data Allready Inserted.');
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



           $data = about::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


            $authName = Auth::user()->first_name.' '.Auth::user()->last_name;
        
            return response()->json(['msg'=>'Data Updated Successfully.','authName'=>$authName]);

        }


    }
    
    public function show($id)
    {

        try{
            $decryptedID = Crypt::decrypt($id);

          
            $data = about::where('id',$decryptedID)->first(); 

            if(empty($data)){
                abort(404);
            }

        }catch (\Exception $e) {
            abort(404);
        }
        return view('Backend\AboutSettings\aboutView',compact('data'));


          
            
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
                $data = about::where('id',$decryptedID)->first();
                return view('Backend\AboutSettings\aboutsettingsAdd',compact('data'));

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
                'title' =>  'max:500',
                'mytextarea' =>'required',
            ]);

            try{
                
                $img_path = about::where('id',$decryptedID)->first();

                if($request->oldImage){

                    $this->validate($request, [
                        'oldImage'=>'image',
                    ]);

                    $image =$request->file('oldImage');
                    $img_name = rand();
                    $text =strtolower($image->getClientOriginalExtension());
                    $img_full_name = $img_name.'.'.$text;
                    $upld_path ='Backend/About_image/';
                    $img_url =$upld_path. $img_full_name;
                    $success =$image->move($upld_path,$img_full_name);
                    unlink($img_path->image);

                    }else{
                        $img_url = $img_path->image;
                    }

                 $data = about::where('id',$decryptedID)
                        ->update([
                            'title'=>$request->title,
                            'text'=>$request->mytextarea,
                            'image'=>$img_url,
                            'updated_by'=> Auth()->user()->id,
                        ]);
                

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('about.add');

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
                $data = about::findOrFail($decrypted);

                unlink($data->image);

                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('about.add');

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