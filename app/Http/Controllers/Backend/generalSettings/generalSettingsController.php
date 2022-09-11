<?php

namespace App\Http\Controllers\Backend\generalSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\generalsetting;
use App\Model\socialSettings;
use App\Model\HeaderTopPosition;
 use Illuminate\Support\Facades\Crypt;

class generalSettingsController extends Controller
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
   
        return view('Backend\GeneralSettings\generalSettingsAdd');
    }

    public function view()
    {
        return view('Backend\GeneralSettings\view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function varifyname(Request $request)
    {

        $name = generalsetting::where('name', $request->name)->get();

        if (count($name) > 0) {
            echo 'false';
        }else{
           echo 'true';

        }


    }

    public function updatevarifyname(Request $request)
    {

        $decryptedID = Crypt::decrypt($request->id);

        $name = generalsetting::where('name', $request->name)->whereNotIn('id',[$decryptedID])->get();

        if (count($name) > 0) {
            echo 'false';
        }else{
           echo 'true';

        }


    }


    public function socialvarifyname(Request $request)
    {

        $name = socialSettings::where('name', $request->name)->get();

        if (count($name) > 0) {
            echo 'false';
        }else{
           echo 'true';

        }


    }


    public function Updatesocialvarifyname(Request $request)
    {

         $decryptedID = Crypt::decrypt($request->id);

        $name = socialSettings::where('name', $request->name)->whereNotIn('id',[$decryptedID])->get();

        if (count($name) > 0) {
            echo 'false';
        }else{
           echo 'true';

        }


    }


    public function store(Request $request)
    {


        if(\Request::isMethod('post')){

            $this->validate($request, [
                'name' =>  'required|in:phone,email,location|unique:generalsettings,name',
                'icon' =>  'required',
                'text' =>  'required|max:200',
                'status' =>'required|in:active,inactive',
            ]);

            try{

                $data = new generalsetting();
                $data->name = $request->name;
                $data->icon = $request->icon;
                $data->text = $request->text;
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


    public function socialstore(Request $request)
    {


        if(\Request::isMethod('post')){

            $this->validate($request, [
                'socialname' =>  'required|unique:social_Settings,name',
                'socialicon' =>  'required',
                'url' =>  'required|url',
                'socialstatus' =>'required|in:active,inactive',
            ]);

            try{

                $data = new socialSettings();
                $data->name = $request->socialname;
                $data->icon = $request->socialicon;
                $data->url = $request->url;
                $data->status = ($request->socialstatus=='active')?'1':'0';
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

            $check = generalsetting::where('id',$decryptedID)->first();

            if($check->header_top_position==1){

                 return response()->json(['check'=>'Sorry!This will not happen now.']);
            }

            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

           $data = generalsetting::where('id',$decryptedID)
                ->update([
                    'status'=>$status,
                    'updated_by'=> Auth()->user()->id,
                ]);


            $authName = Auth::user()->first_name.' '.Auth::user()->last_name;

            return response()->json(['msg'=>'Data Updated Successfully.','authName'=>$authName]);

        }


    }


     public function socialstatus(Request $request)
    {

        if($request->isMethod('post')){

            $decryptedID = Crypt::decrypt($request->dataId);

               $check = socialSettings::where('id',$decryptedID)->first();

            if($check->position_customize==1){

                 return response()->json(['check'=>'Sorry!This will not happen now.']);
            }

            if($request->val=="true"){
                 $status =1;
            }else{
                $status=0;
            }

           $data = socialSettings::where('id',$decryptedID)
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
                $general = generalsetting::where('id',$decryptedID)->first();

                 if(!$general ->header_top_position==0){
                    toastr()->error('Sorry!This will not happen now.');
                     return redirect()->back();
                 }else{
                    return view('Backend\GeneralSettings\generalSettingsAdd',compact('general'));
                 }




                

            }catch (\Exception $e) {

                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }



        }

    }


    public function socialedit(Request $request,$id)
    {
        if($request->isMethod('get')){
            try{


                $decryptedID = Crypt::decrypt($id);
                $data = socialSettings::where('id',$decryptedID)->first();
                return view('Backend\GeneralSettings\generalSettingsAdd',compact('data'));

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
                'name' =>  'required|in:phone,email,location|unique:generalsettings,name,'.$decryptedID,
                'icon' =>  'required',
                'text' =>  'required|max:200',
                'status' =>'required|in:active,inactive',
            ]);

            try{

                $check = generalsetting::where('id',$decryptedID)->where('header_top_position',1)->first();

                if($check==null){
                    $status = ($request->status=='active')?'1':'0';
                }else{
                    $status = $check->status;
                }

                 $data = generalsetting::where('id',$decryptedID)
                            ->update([
                                'name'=>$request->name,
                                'icon'=>$request->icon,
                                'text'=>$request->text,
                                'status'=>$status,
                                'updated_by'=> Auth()->user()->id,
                            ]);
               

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('general.view');

            }catch (\Exception $e) {

                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }



        }
    }

    public function socialupdate(Request $request, $id)
    {

        if($request->isMethod('post')){
            $decryptedID = Crypt::decrypt($id);

             $this->validate($request, [
                'socialname' =>  'required|unique:social_Settings,name,'.$decryptedID,
                'socialicon' =>  'required',
                'url' =>  'required|url',
                'socialstatus' =>'required|in:active,inactive',
            ]);

            try{

                 $check = socialSettings::where('id',$decryptedID)->where('position_customize',1)->first();

                if($check==null){
                    $status = ($request->status=='active')?'1':'0';
                }else{
                    $status = $check->status;
                }

                 $data = socialSettings::where('id',$decryptedID)
                            ->update([
                                'name'=>$request->socialname,
                                'icon'=>$request->socialicon,
                                'url'=>$request->url,
                                'status'=>$status,
                                'updated_by'=> Auth()->user()->id,
                            ]);

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('general.view');

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
                $data = generalsetting::findOrFail($decrypted);

                    if($data->header_top_position==1){
                        toastr()->error('Sorry!This will not happen now.');
                        return redirect()->back();
                    }

                 $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('general.add');

            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps!Something went wrong.');
            return redirect()->back();
        }

    }


      public function socialdestroy(Request $request,$id)
    {


        if($request->isMethod('get')){

            try{
                $decrypted = Crypt::decrypt($id);
                $data = socialSettings::findOrFail($decrypted);
                
                if($data->position_customize==1){
                        toastr()->error('Sorry!This will not happen now.');
                        return redirect()->back();
                    }

                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('general.view');

            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }else{
            toastr()->error('Opps!Something went wrong.');
            return redirect()->back();
        }

    }

    // Left Position Controller
    public function headerLeftposition(Request $request)
    {
         if($request->isMethod('post')){

            try{

                     //id decrypt
                $decryptedID = Crypt::decrypt($request->val);

                //duble inserted check
                $duble = HeaderTopPosition::where('gen_id',$decryptedID)
                    ->where('position','left')
                    ->first();

                if(!$duble==null){

                    //update
                     $general = generalsetting::where('id',$decryptedID)->whereNotIn('id',HeaderTopPosition::where('position','footer')->orwhere('position','right')->pluck('gen_id'))
                            ->update([
                        'header_top_position'=>0,
                        ]);

                    //deleted
                    $header = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','left')->delete();

                    dd('Data updated');

                }


                //status check
                $generalsetting = generalsetting::where('id',$decryptedID)->where('status',1)->first();

                if($generalsetting==null){
                    return response()->json(['check'=>'Opps!Something went wrong.']);
                }

                //serial check
                $check = HeaderTopPosition::where('position','left')->orderBy('sl','asc')->get();

                $count = $check->count();

                $sl=0;
                //serial check sl update
                if($count>0){
                    foreach($check as $key){
                        $sl++;
                       HeaderTopPosition::where('id',$key->id)->update([
                        'sl'=>$sl,
                       ]);
                    };

                    $countVal = $count;

                }else{
                    $countVal = 0;
                }

                //inserted
                $data = new HeaderTopPosition();
                $data->gen_id = $decryptedID;
                $data->position = 'left';
                $data->sl = $countVal+1;
                 $data->created_by = Auth()->user()->id;
                $data->save();

                //loop
                generalsetting::where('id',$decryptedID)
                    ->update([
                        'header_top_position'=>1,
                    ]);
            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }

    }

    // Right Position Controller
    public function headerRightposition(Request $request)
    {
          if($request->isMethod('post')){

            try{

                     //id decrypt
                $decryptedID = Crypt::decrypt($request->val);

                //duble inserted check
                $duble = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','right')->first();

                if(!$duble==null){



                    //update
                     $general = generalsetting::where('id',$decryptedID)->whereNotIn('id',HeaderTopPosition::where('position','left')->orwhere('position','footer')->pluck('gen_id'))
                            ->update([
                        'header_top_position'=>0,
                        ]);

                    //deleted
                    $header = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','right')->delete();

                    dd('Data updated');

                }


                //status check
                $generalsetting = generalsetting::where('id',$decryptedID)->where('status',1)->first();

                if($generalsetting==null){
                    return response()->json(['check'=>'Opps!Something went wrong.']);
                }

                //serial check
                $check = HeaderTopPosition::where('position','right')->orderBy('sl','asc')->get();

                $count = $check->count();

                $sl=0;
                //serial check sl update
                if($count>0){
                    foreach($check as $key){
                        $sl++;
                       HeaderTopPosition::where('id',$key->id)->update([
                        'sl'=>$sl,
                       ]);
                    };

                    $countVal = $count;

                }else{
                    $countVal = 0;
                }

                //inserted
                $data = new HeaderTopPosition();
                $data->gen_id = $decryptedID;
                $data->position = 'right';
                $data->sl = $countVal+1;
                 $data->created_by = Auth()->user()->id;
                $data->save();

                //loop
                generalsetting::where('id',$decryptedID)
                    ->update([
                        'header_top_position'=>1,
                    ]);
            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }

    }

 // Footer Position Controller
    public function footerposition(Request $request)
    {
          if($request->isMethod('post')){

            try{

                     //id decrypt
                $decryptedID = Crypt::decrypt($request->val);


                //duble inserted check
                $duble = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','footer')->first();

                if(!$duble==null){

                    //update
                     $general = generalsetting::where('id',$decryptedID)->whereNotIn('id',HeaderTopPosition::where('position','left')->orwhere('position','right')->pluck('gen_id'))
                            ->update([
                        'header_top_position'=>0,
                        ]);

                    //deleted
                    $header = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','footer')->delete();

                    dd('Data updated');

                }


                //status check
                $generalsetting = generalsetting::where('id',$decryptedID)->where('status',1)->first();

                if($generalsetting==null){
                    return response()->json(['check'=>'Opps!Something went wrong.']);
                }

                //serial check
                $check = HeaderTopPosition::where('position','footer')->orderBy('sl','asc')->get();

                $count = $check->count();

                $sl=0;
                //serial check sl update
                if($count>0){
                    foreach($check as $key){
                        $sl++;
                       HeaderTopPosition::where('id',$key->id)->update([
                        'sl'=>$sl,
                       ]);
                    };

                    $countVal = $count;

                }else{
                    $countVal = 0;
                }

                //inserted
                $data = new HeaderTopPosition();
                $data->gen_id = $decryptedID;
                $data->position = 'footer';
                $data->sl = $countVal+1;
                 $data->created_by = Auth()->user()->id;
                $data->save();

                //loop
                generalsetting::where('id',$decryptedID)
                    ->update([
                        'header_top_position'=>1,
                    ]);
            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }

    }


 // Social Left Position Controller
    public function socialleftposition(Request $request)
    {
          if($request->isMethod('post')){

            try{

                    //id decrypt
                $decryptedID = Crypt::decrypt($request->val);


                //duble inserted check
                $duble = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','socialleft')->first();

                if(!$duble==null){
                    //update


                    $general = socialSettings::where('id',$decryptedID)->whereNotIn('id',HeaderTopPosition::where('position','socialright')->orwhere('position','socialfooter')->pluck('gen_id'))
                            ->update([
                        'position_customize'=>0,
                        ]);

                    //deleted
                    $header = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','socialleft')->delete();

                    dd('Data updated');

                }


                //status check
                $socialSettings = socialSettings::where('id',$decryptedID)->where('status',1)->first();

                if($socialSettings==null){
                    return response()->json(['check'=>'Opps!Something went wrong.']);
                }

                //serial check
                $check = HeaderTopPosition::where('position','socialleft')->orderBy('sl','asc')->get();

                $count = $check->count();

                $sl=0;
                //serial check sl update
                if($count>0){
                    foreach($check as $key){
                        $sl++;
                       HeaderTopPosition::where('id',$key->id)->update([
                        'sl'=>$sl,
                       ]);
                    };

                    $countVal = $count;

                }else{
                    $countVal = 0;
                }

                //inserted
                $data = new HeaderTopPosition();
                $data->gen_id = $decryptedID;
                $data->position = 'socialleft';
                $data->sl = $countVal+1;
                 $data->created_by = Auth()->user()->id;
                $data->save();

                //loop
                socialSettings::where('id',$decryptedID)
                    ->update([
                        'position_customize'=>1,
                    ]);
            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }

    }


     // Social Right Position Controller
    public function socialrightposition(Request $request)
    {
          if($request->isMethod('post')){

            try{

                    //id decrypt
                $decryptedID = Crypt::decrypt($request->val);


                //duble inserted check
                $duble = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','socialright')->first();

                if(!$duble==null){
                    //update


                    $general = socialSettings::where('id',$decryptedID)->whereNotIn('id',HeaderTopPosition::where('position','socialleft')->orwhere('position','socialfooter')->pluck('gen_id'))
                            ->update([
                        'position_customize'=>0,
                        ]);

                    //deleted
                    $header = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','socialright')->delete();

                    dd('Data updated');

                }


                //status check
                $socialSettings = socialSettings::where('id',$decryptedID)->where('status',1)->first();

                if($socialSettings==null){
                    return response()->json(['check'=>'Opps!Something went wrong.']);
                }

                //serial check
                $check = HeaderTopPosition::where('position','socialright')->orderBy('sl','asc')->get();

                $count = $check->count();

                $sl=0;
                //serial check sl update
                if($count>0){
                    foreach($check as $key){
                        $sl++;
                       HeaderTopPosition::where('id',$key->id)->update([
                        'sl'=>$sl,
                       ]);
                    };

                    $countVal = $count;

                }else{
                    $countVal = 0;
                }

                //inserted
                $data = new HeaderTopPosition();
                $data->gen_id = $decryptedID;
                $data->position = 'socialright';
                $data->sl = $countVal+1;
                 $data->created_by = Auth()->user()->id;
                $data->save();

                //loop
                socialSettings::where('id',$decryptedID)
                    ->update([
                        'position_customize'=>1,
                    ]);
            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }

    }


     // Social Footer Position Controller
    public function socialfooterposition(Request $request)
    {

          if($request->isMethod('post')){

            try{

                    //id decrypt
                $decryptedID = Crypt::decrypt($request->val);


                //duble inserted check
                $duble = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','socialfooter')->first();

                if(!$duble==null){
                    //update


                    $general = socialSettings::where('id',$decryptedID)->whereNotIn('id',HeaderTopPosition::where('position','socialleft')->orwhere('position','socialright')->pluck('gen_id'))
                            ->update([
                        'position_customize'=>0,
                        ]);

                    //deleted
                    $header = HeaderTopPosition::where('gen_id',$decryptedID)->where('position','socialfooter')->delete();

                    dd('Data updated');

                }


                //status check
                $socialSettings = socialSettings::where('id',$decryptedID)->where('status',1)->first();

                if($socialSettings==null){
                    return response()->json(['check'=>'Opps!Something went wrong.']);
                }

                //serial check
                $check = HeaderTopPosition::where('position','socialfooter')->orderBy('sl','asc')->get();

                $count = $check->count();

                $sl=0;
                //serial check sl update
                if($count>0){
                    foreach($check as $key){
                        $sl++;
                       HeaderTopPosition::where('id',$key->id)->update([
                        'sl'=>$sl,
                       ]);
                    };

                    $countVal = $count;

                }else{
                    $countVal = 0;
                }

                //inserted
                $data = new HeaderTopPosition();
                $data->gen_id = $decryptedID;
                $data->position = 'socialfooter';
                $data->sl = $countVal+1;
                 $data->created_by = Auth()->user()->id;
                $data->save();

                //loop
                socialSettings::where('id',$decryptedID)
                    ->update([
                        'position_customize'=>1,
                    ]);
            }catch (\Exception $e) {
                toastr()->error('Opps!Something went wrong.');
                return redirect()->back();
            }
        }

    }









}
