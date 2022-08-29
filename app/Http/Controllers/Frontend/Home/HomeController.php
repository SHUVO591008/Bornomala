<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;




class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function login()
    {
    
        return view('auth.login');
    }

    
    public function index()
    {
      
       return view('Frontend.index');
    }

    public function upcoming()
    {
       return view('Frontend.upcoming');
    }

    public function teacher()
    {
       return view('Frontend.teacher');
    }

     public function about()
    {
       return view('Frontend.about');
    }

      public function contact()
    {
       return view('Frontend.contact');
    }

    public function gallery()
    {
       return view('Frontend.gallery');
    }

    public function PrivacyPolicy()
    {
       return view('Frontend.PrivacyPolicy');
    }

      public function TermsConditions()
    {
       return view('Frontend.termsconditions');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

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
