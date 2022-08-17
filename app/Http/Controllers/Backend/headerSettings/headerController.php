<?php

namespace App\Http\Controllers\Backend\headerSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\header;
 use Illuminate\Support\Facades\Crypt;

class headerController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function add()
    {
        return view('Backend\HeaderSettings\headersettingsAdd');
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
                'title' =>  'required|max:100',
                'icon' =>  'required',
                'text' =>  'required|max:200',
                'author_name' =>  'max:50',
                'status' =>'required|in:active,inactive',
            ]);

            try{

                $data = new header();
                $data->title = $request->title;
                $data->icon = $request->icon;
                $data->text = $request->text;
                $data->author_name = $request->author_name;
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

           $data = header::where('id',$decryptedID)
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
                $data = header::where('id',$decryptedID)->first();
                return view('Backend\HeaderSettings\headersettingsAdd',compact('data'));

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
                'title' =>  'required|max:100',
                'icon' =>  'required',
                'text' =>  'required|max:200',
                'author_name' =>  'max:50',
                'status' =>'required|in:active,inactive',
            ]);

            try{
                 $data = header::where('id',$decryptedID)
                        ->update([
                            'title'=>$request->title,
                            'icon'=>$request->icon,
                            'text'=>$request->text,
                            'author_name'=>$request->author_name,
                            'status'=>($request->status=='active')?'1':'0',
                            'updated_by'=> Auth()->user()->id,
                        ]);

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('header.add');

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
                $data = header::findOrFail($decrypted);
                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('header.add');

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
