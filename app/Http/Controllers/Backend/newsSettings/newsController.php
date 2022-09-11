<?php

namespace App\Http\Controllers\Backend\newsSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\news;
use App\Model\newsScrollBar;
 use Illuminate\Support\Facades\Crypt;

class newsController extends Controller
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
        return view('Backend\NewsSettings\newssettingsAdd');
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
                'status' =>'required|in:active,inactive',
            ]);

            if($request->url){
                 $this->validate($request, [
                'url' =>  'url',
                ]);
            }

            try{

                $data = new news();
                $data->title = $request->title;
                $data->url = $request->url;
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

    public function status(Request $request)
    {

        if($request->isMethod('post')){

            $decryptedID = Crypt::decrypt($request->dataId);

            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

           $data = news::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


            $authName = Auth::user()->first_name.' '.Auth::user()->last_name;
        
            return response()->json(['msg'=>'Data Updated Successfully.','authName'=>$authName]);

        }


    }

      public function scrollBar(Request $request)
    {

        if($request->isMethod('post')){

            $newsScrollBar = newsScrollBar::first();

            if($newsScrollBar==NULL){

                if($request->val=="true"){
                    $status =1;
                }else{
                    $status=0;
                }

                $data = new newsScrollBar();
                $data->status = $status;
                $data->created_by = Auth()->user()->id;
                $data->save();

               return response()->json(['msg'=>'Data Updated Successfully.']);


            }else{

                $decryptedID = Crypt::decrypt($request->dataId);

                if($request->val=="true"){
                     $status =1;
                }else{
                    $status=0;
                }

               $data = newsScrollBar::where('id',$decryptedID)
                    ->update([
                        'status'=>$status,
                        'updated_by'=> Auth()->user()->id,
                    ]);

                return response()->json(['msg'=>'Data Updated Successfully.']);
            }


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
                $data = news::where('id',$decryptedID)->first();
                return view('Backend\NewsSettings\newssettingsAdd',compact('data'));

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
                'status' =>'required|in:active,inactive',
            ]);

            if($request->url){
                 $this->validate($request, [
                'url' =>  'url',
                ]);
            }

            try{
                 $data = news::where('id',$decryptedID)
                        ->update([
                            'title'=>$request->title,
                            'url'=>$request->url,
                            'status'=>($request->status=='active')?'1':'0',
                            'updated_by'=> Auth()->user()->id,
                        ]);

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('news.add');

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
                $data = news::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('news.add');

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
