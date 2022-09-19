<?php

namespace App\Http\Controllers\Backend\system\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;


class AdmissionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:webadmin');
    }

     public function NewAdmission()
    {
        $year=DB::table('years')->get();

        return view('Backend.system.admission.admission',compact('year'));
    }


}
