<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\gallery;
use Validator;


class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function varifyuserName(Request $request)
        {

            $userName = User::where('user_name', $request->username)->get();

            if (count($userName) > 0) {
                echo 'false';
            }else{
               echo 'true';

            } 

           
        }

    public function varifyemail(Request $request)
        {

            $email = User::where('email', $request->email)->get();

            if (count($email) > 0) {
                echo 'false';
            }else{
               echo 'true';

            } 

           
        }


    public function varifyGroupName(Request $request)
        {

            $this->middleware('auth');

            $gallery = gallery::where('group_name', $request->group_name)->get();
            $gallery1 = gallery::where('slug', $request->slug)->get();

             if (count($gallery) > 0) {

                if($request->slug){

                    if($gallery1->isEmpty()){
                        echo 'false';
                    }else{

                        if($gallery[0]->group_name!==$gallery1[0]->group_name){

                                $validator = Validator::make($request->all(), [
                                    'group_name' => 'unique:galleries,group_name',

                                ]);

                                if ($validator->passes()) {
                                  echo 'truadade';
                                    return response()->json(['success'=>'Added new records.']);
                                }
             
                                echo 'false';

                           }else{
                            echo 'true';
                           }
                   }

                 }else{
                     echo 'false';
                 }

                


                }else{
                   echo 'true';
                } 


             

             

           
        }


    public function index()
    {
        //
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
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
