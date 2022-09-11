<?php

namespace App\Http\Controllers\Backend\sliderSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\slider;
use Illuminate\Support\Facades\Crypt;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
       $this->middleware('auth:webadmin');
    }


      public function add()
    {
        return view('Backend\SliderSettings\sliderSettingsAdd');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function show($id)
    {



        try{
            $decryptedID = Crypt::decrypt($id);
          
            $data = slider::where('id',$decryptedID)->first(); 

            if(empty($data)){
                abort(404);
            }

        }catch (\Exception $e) {
            abort(404);
        }
        return view('Backend\SliderSettings\sliderView',compact('data'));


          
            
    }

    public function sliderStatusShowHide(Request $request)
    {

        $Unpublished = slider::where('status','0')->count();

        $published = slider::where('status','1')->count();

        return response()->json(['Unpublished' => $Unpublished, 'published' => $published]);
        
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
                'title' =>  'max:300',
                'style' =>  'required|in:cube,cubeRandom,block,cubeStop,cubeStopRandom,cubeHide,cubeSize,horizontal,showBars,showBarsRandom,tube,fade,fadeFour,paralell,blind,blindHeight,blindWidth,directionTop,directionBottom,directionRight,directionLeft,cubeSpread,glassCube,glassBlock,circles,circlesInside,circlesRotate,cubeShow,upBars,downBars,hideBars,swapBars,swapBarsBack,swapBlocks,cut',
                'image' =>  'required',
                'status' =>'required|in:active,inactive',
            ]);


            try{

                $data = new slider();
                $data->text = $request->title;
                $data->style = $request->style;
                $data->status = ($request->status=='active')?'1':'0';
                $data->created_by = Auth()->user()->id;

                $image =$request->file('image');
                $img_name = rand();
                $text =strtolower($image->getClientOriginalExtension());
                $img_full_name = $img_name.'.'.$text;
                $upld_path ='Backend/slider_image/';
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



           $data = slider::where('id',$decryptedID)
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
                $data = slider::where('id',$decryptedID)->first();

                return view('Backend\SliderSettings\sliderSettingsAdd',compact('data'));

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
                'title' =>  'max:300',
                'style' =>  'required|in:cube,cubeRandom,block,cubeStop,cubeStopRandom,cubeHide,cubeSize,horizontal,showBars,showBarsRandom,tube,fade,fadeFour,paralell,blind,blindHeight,blindWidth,directionTop,directionBottom,directionRight,directionLeft,cubeSpread,glassCube,glassBlock,circles,circlesInside,circlesRotate,cubeShow,upBars,downBars,hideBars,swapBars,swapBarsBack,swapBlocks,cut',
                'status' =>'required|in:active,inactive',
            ]);




            try{
                
                $img_path = slider::where('id',$decryptedID)->first();

                if($request->image){

                    $image =$request->file('image');
                    $img_name = rand();
                    $text =strtolower($image->getClientOriginalExtension());
                    $img_full_name = $img_name.'.'.$text;
                    $upld_path ='Backend/slider_image/';
                    $img_url =$upld_path. $img_full_name;
                    $success =$image->move($upld_path,$img_full_name);
                    unlink($img_path->image);

                    }else{
                        $img_url = $img_path->image;
                    }

                 $data = slider::where('id',$decryptedID)
                        ->update([
                            'text'=>$request->title,
                            'style'=>$request->style,
                            'status'=>($request->status=='active')?'1':'0',
                            'image'=>$img_url,
                            'updated_by'=> Auth()->user()->id,
                        ]);
                

                toastr()->success('Data Updated Successfully.');
                return redirect()->route('slider.add');

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
                $data = slider::findOrFail($decrypted);

                unlink($data->image);

                $data->delete();
                toastr()->success('Data Deleted Successfully.');
                return redirect()->route('slider.add');

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
