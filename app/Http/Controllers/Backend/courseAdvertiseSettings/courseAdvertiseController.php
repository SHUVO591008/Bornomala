<?php

namespace App\Http\Controllers\Backend\courseAdvertiseSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\courseAdvertise;
use Illuminate\Support\Facades\Crypt;

class courseAdvertiseController extends Controller
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
        return view('Backend\courseAdvertise\courseAdvertiseAdd');
    }


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
                'title' =>  'required|max:200',
                'position' =>  'required|in:left,right',
                'text' =>'required',
                'btn' =>  'required|in:on,off',
                'btn_url' =>  'url|nullable',
                'status' =>'required|in:active,inactive',
                'image'=>'required|image',
            ]);

        

            try{

                $data = new courseAdvertise();
                $data->title = $request->title;
                $data->position = $request->position;
                $data->des = $request->text;
                $data->btn = $request->btn;
                $data->btn_url = $request->btn_url;
                $data->created_by = Auth()->user()->id;
                $data->status = ($request->status=='active')?'1':'0';

                $image =$request->file('image');
                $img_name = rand();
                $text =strtolower($image->getClientOriginalExtension());
                $img_full_name = $img_name.'.'.$text;
                $upld_path ='Backend/courseAdvertisementImage/';
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



           $data = courseAdvertise::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


            $authName = Auth::user()->first_name.' '.Auth::user()->last_name;
        
            return response()->json(['msg'=>'Data Updated Successfully.','authName'=>$authName]);

        }


    }


    public function btn(Request $request)
    {



        if($request->isMethod('post')){
            $decryptedID = Crypt::decrypt($request->dataId);

            if($request->val=="true"){
                 $btn ='on';
            }else{
                $btn='off';
            }



           $data = courseAdvertise::where('id',$decryptedID)
                ->update([
                    'btn'=>$btn,
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
                $data = courseAdvertise::where('id',$decryptedID)->first();
                return view('Backend\courseAdvertise\courseAdvertiseAdd',compact('data'));

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
                'position' =>  'required|in:left,right',
                'text' =>'required',
                'btn' =>  'required|in:on,off',
                'btn_url' =>  'url|nullable',
                'status' =>'required|in:active,inactive',
            ]);


            try{
                
                $img_path = courseAdvertise::where('id',$decryptedID)->first();

                if($request->image){

                    $this->validate($request, [
                        'image' =>'required|image',
                    ]);

                    $image =$request->file('image');
                    $img_name = rand();
                    $text =strtolower($image->getClientOriginalExtension());
                    $img_full_name = $img_name.'.'.$text;
                    $upld_path ='Backend/courseAdvertisementImage/';
                    $img_url =$upld_path. $img_full_name;
                    $success =$image->move($upld_path,$img_full_name);
                    unlink($img_path->image);

                    }else{
                        $img_url = $img_path->image;
                    }

                 $data = courseAdvertise::where('id',$decryptedID)
                        ->update([
                            'title' => $request->title,
                            'position' => $request->position,
                            'des' => $request->text,
                            'btn' => $request->btn,
                            'btn_url' => $request->btn_url,
                            'updated_by'=> Auth()->user()->id,
                            'status' => ($request->status=='active')?'1':'0',
                            'image'=>$img_url,
                            
                        ]);
                

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('courseAdvertise.add');

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
                $data = courseAdvertise::findOrFail($decrypted);

                unlink($data->image);

                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('courseAdvertise.add');

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
