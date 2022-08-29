<?php

namespace App\Http\Controllers\Backend\gallerySettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\gallery;

use Webklex\IMAP\Facades\Client;

class GalleryController extends Controller
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
   public function add(Request $request)
    {    

   
        $gallery = gallery::orderBy('id','desc')->groupBy('group_name')->get();

        return view('Backend\GallerySettings\add',compact('gallery'));
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
        $this->validate($request, [
            'group_name' => 'required|string|unique:galleries,group_name',
            'image' => 'required'
        ]);


        if ($request->hasFile('image')){
           
            $allowedfileExtension=['jpeg','JPEG','JPG','jpg','PNG','png','gif','GIF'];
            $files = $request->file('image');

            

            foreach($files as $file){ 

                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if($check)
                {
                    $image_name = rand();
                    $text =strtolower($file->getClientOriginalExtension());

                    $image_full_name = $image_name.'.'.$text;
                    $upld_path ='Backend/gallery/';
                    $image_url =$upld_path. $image_full_name;
                    $success =$file->move($upld_path,$image_full_name);

                    gallery::create([
                        'group_name' => $request->group_name,
                        'slug' => str_slug($request->group_name),
                        'image' => $image_url,
                        'created_by'=> Auth()->user()->id,
                    ]);

                    


                    
                }else{
                    toastr()->error('Sorry! Only Upload png,jpg,png,gif.');
                    return redirect()->back();

                }

            }
        }

        toastr()->success('Data Created Successfully.');
        return redirect()->route('gallery.add');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function View(Request $request,$slug)
    {

        $data = gallery::where('slug',$request->slug)->get();

        

        if(!count($data)==0){

            return view('Backend\GallerySettings\view', compact('data'));
            
        }else{
           toastr()->error('Opps!Something went wrong');
            return redirect()->back();
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$slug)
    {
         $edit = gallery::where('slug',$request->slug)->get();

        if(!count($edit)==0){

            return view('Backend\GallerySettings\edit', compact('edit'));
            
        }else{
            toastr()->error('Opps!Something went wrong');
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
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'group_name' => 'required|string',
            
        ]);
       

        $check = gallery::where('slug',$slug)->get();

    
        if(!count($check)==0){

            $finalCheck = gallery::where('group_name',$request->group_name)->first();

            if($finalCheck==null){


                if ($request->hasFile('image')){
                    $allowedfileExtension=['jpeg','JPEG','JPG','jpg','PNG','png','gif','GIF'];
                    $files = $request->file('image');

        
                    gallery::where('group_name',$check[0]->group_name)->delete();
                    foreach($files as $file){ 
        
                        $extension = $file->getClientOriginalExtension();
                        $checkimage=in_array($extension,$allowedfileExtension);
        
                        if($checkimage)
                        {

                         
                            $image_name = rand();
                            $text =strtolower($file->getClientOriginalExtension());
        
                            $image_full_name = $image_name.'.'.$text;
                            $upld_path ='Backend/gallery/';
                            $image_url =$upld_path. $image_full_name;
                            $success =$file->move($upld_path,$image_full_name);
                          
                            gallery::create([
                                'group_name' => $request->group_name,
                                'slug' => str_slug($request->group_name),
                                'image' => $image_url,
                                 'created_by'=> Auth()->user()->id,
                            ]);

                            

                        }else{
                            toastr()->error('Sorry! Only Upload png,jpg,png,gif');
                            return redirect()->back();
                            
                        }
        
                    }


                    foreach($check as $imageValue){
                        $unlink = unlink($imageValue->image);
                    }

                     toastr()->success('Data Created Successfully.');
                     return redirect()->route('gallery.add');

                    
                }else{

                 

                    gallery::where('group_name',$check[0]->group_name)->update([
                        'group_name' => $request->group_name,
                        'slug' => str_slug($request->group_name),
                         'updated_by'=> Auth()->user()->id,
                    ]);

                      toastr()->success('Data Created Successfully.');
                     return redirect()->route('gallery.add');


                }
        
            }else{
               
                if($finalCheck->group_name!==$check[0]->group_name){
                    $this->validate($request, [
                        'group_name' => 'unique:galleries,group_name',
                        
                    ]);
                }


                if ($request->hasFile('image')){
                        $allowedfileExtension=['jpeg','JPEG','JPG','jpg','PNG','png','gif','GIF'];
                        $files = $request->file('image');

                         gallery::where('group_name',$check[0]->group_name)->delete();
                                

                        foreach($files as $file){ 


            
                            $extension = $file->getClientOriginalExtension();
                            $checkimage=in_array($extension,$allowedfileExtension);
            
                            if($checkimage)
                            {
                               
                    
                                $image_name = rand();
                                $text =strtolower($file->getClientOriginalExtension());
            
                                $image_full_name = $image_name.'.'.$text;
                                $upld_path ='Backend/gallery/';
                                $image_url =$upld_path. $image_full_name;
                                $success =$file->move($upld_path,$image_full_name);
                            
                                gallery::create([
                                    'group_name' => $request->group_name,
                                    'slug' => str_slug($request->group_name),
                                    'image' => $image_url,
                                     'created_by'=> Auth()->user()->id,
                                ]);

                                

                            }else{
                                 toastr()->error('Sorry! Only Upload png,jpg,png,gif');
                                return redirect()->back();
                            }
            
                        }

                        foreach($check as $imageValue){
                            $unlink = unlink($imageValue->image);
                        }

                        toastr()->success('Data Created Successfully.');
                         return redirect()->route('gallery.add');
                            
                        
                    }else{

                        gallery::where('group_name',$check[0]->group_name)->update([
                            'group_name' => $request->group_name,
                            'slug' => str_slug($request->group_name),
                             'updated_by'=> Auth()->user()->id,
                        ]);

                       toastr()->success('Data Created Successfully.');
                         return redirect()->route('gallery.add');


                    }
                
            }

        
 
            
        }else{
             toastr()->error('Opps!Something went wrong');
            return redirect()->back();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$slug)
    {
         if($request->isMethod('get')){

            try{
                 $check = gallery::where('slug',$slug)->get();

                if(!count($check)==0){

                    foreach($check as $imageValue){

                        gallery::where('group_name',$imageValue->group_name)->delete();
            
                        $unlink = unlink($imageValue->image);
                    }

                   toastr()->success('Data Deleted Successfully.');
                    return redirect()->back();

                }else{
                   toastr()->error('Opps!Something went wrong.');
                    return redirect()->back();
                }

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
