<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Settings;
use Illuminate\Support\Facades\Crypt;


class settingsController extends Controller
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
     public function add()
    {



        return view('Backend\Settings\SettingsAdd');
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
                'name' =>  'required|max:50',
                'logo' =>  'required|image',
                'favicon' =>  'required|image',

            ]);


            try{

                $valid = settings::first();

                if($valid){
                    toastr()->error('Data Allready Inserted.');
                    return redirect()->back();
                }

                $data = new settings();
                $data->name = $request->name;
                $data->created_by = Auth()->user()->id;

                $logo =$request->file('logo');
                $logo_name = rand();
                $logotext =strtolower($logo->getClientOriginalExtension());
                $logo_full_name = $logo_name.'.'.$logotext;
                $logo_upld_path ='Backend/logo/';
                $logo_url =$logo_upld_path. $logo_full_name;
                $logosuccess =$logo->move($logo_upld_path,$logo_full_name);
                $data->logo = $logo_url;


                $favicon =$request->file('favicon');
                $favicon_name = rand();
                $text =strtolower($favicon->getClientOriginalExtension());
                $favicon_full_name = $favicon_name.'.'.$text;
                $favicon_upld_path ='Backend/logo/';
                $favicon_url =$favicon_upld_path. $favicon_full_name;
                $success =$favicon->move($favicon_upld_path,$favicon_full_name);
                $data->favicon = $favicon_url;

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
                $data = settings::where('id',$decryptedID)->first();

                return view('Backend\Settings\SettingsAdd',compact('data'));

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
                'name' =>  'required|max:50',
            ]);

             if($request->logo){
                 $this->validate($request, [
                    'logo' =>  'required|image',
                ]);
             }

              if($request->favicon){
                 $this->validate($request, [
                    'favicon' =>  'required|image',
                ]);
             }




            try{
                
                $path = settings::where('id',$decryptedID)->first();

                if($request->logo){

                    $logo =$request->file('logo');
                    $logo_name = rand();
                    $logotext =strtolower($logo->getClientOriginalExtension());
                    $logo_full_name = $logo_name.'.'.$logotext;
                    $logo_upld_path ='Backend/logo/';
                    $logo_url =$logo_upld_path. $logo_full_name;
                    $logosuccess =$logo->move($logo_upld_path,$logo_full_name);
                    unlink($path->logo);

                }else{
                    $logo_url = $path->logo;
                }


                if($request->favicon){

                    $favicon =$request->file('favicon');
                    $favicon_name = rand();
                    $favicontext =strtolower($favicon->getClientOriginalExtension());
                    $favicon_full_name = $favicon_name.'.'.$favicontext;
                    $favicon_upld_path ='Backend/logo/';
                    $favicon_url =$favicon_upld_path. $favicon_full_name;
                    $faviconsuccess =$favicon->move($favicon_upld_path,$favicon_full_name);
                    unlink($path->favicon);

                }else{
                    $favicon_url = $path->favicon;
                }


                 $data = settings::where('id',$decryptedID)
                        ->update([
                            'name'=>$request->name,
                            'logo'=>$logo_url,
                            'favicon'=>$favicon_url,
                            'updated_by'=> Auth()->user()->id,
                        ]);
                

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('settings.add');

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
                $data = settings::findOrFail($decrypted);

                unlink($data->logo);
                unlink($data->favicon);

                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('settings.add');

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
