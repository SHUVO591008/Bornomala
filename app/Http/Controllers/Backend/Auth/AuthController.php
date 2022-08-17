<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\User;
use App\verifyUser;
use App\Mail\verifyEmail;
use Hash;
Use \Carbon\Carbon;
use Str;
use Cookie;
use Mail;
use Crypt;


class AuthController extends Controller
{
    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function showLoginForm()
    {
      if(Auth::check()){
        return redirect()->back();
      }else{
        return view('auth.login');
      }
        
    }

      public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
       
         //coustom code
         $input = $request->all();

         $this->validate($request,[
            'email' =>'required',
            'password' =>'required'
        ]);

        $email = $request->email;
        $password = $request->password;


    
        $validData = User::where('email',$email)->orWhere('user_name', $email)->first();
        // $password_check = password_verify($password,@$validData->password);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

        

        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))
        {
           // Remember start  Cookie

            if($request->has('remember')){
                Cookie::queue('email',$email,1440);
                Cookie::queue('password',$password,1440);
            }else{
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }

           // Remember end Cookie

            if($validData->email_verified_at==null){
                Auth::logout();
                return redirect()->back()->with('msg','Sorry! You are not verified yet');
            }

             if($validData->status=='inactive'){
                 Auth::logout();
                return redirect()->back()->with('msg','"Please wait..."Your ID is being monitored.');
            }
            //other Devices Logout
            Auth::logoutOtherDevices($request->input('password'));

            return redirect()->route('dashboard');

        }else{
            return redirect()->route('login')
                ->with('msg','Email/Username or Password does not match!.');
        }


    }

    public function verifyEmail($token){

        $verifiedUser = verifyUser::where('token',$token)->first();
        if(isset($verifiedUser)){
            $user = $verifiedUser->User;

            if(!$user->email_verified_at){
                $user->email_verified_at=Carbon::now();
                $user->save();
                return \redirect(route('login'))->with('success','Your Email Has Verified.');
            }else{
                 return \redirect()->back()->with('success','Your Email Has Already Been Verified.');
            }
        }else{
            return \redirect(route('login'))->with('msg','Somthings Went Wrong!');
        }
    }

     public function create(Request $request)
    {

          if($request->email){
                $this->validate($request, [
                    'email'=> 'string|email|unique:users,email',
                ]);

            }

            $this->validate($request, [
                'username' =>  'required|min:5|unique:users,user_name',
                'mobile' =>  ['required','numeric','min:11','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            ]);


        $unique_id = "B".mt_rand(1000, 9999);
         $user = User::create([
            'unique_id' => $unique_id.Carbon::now()->second,
            'user_name' => $request['username'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'role' =>'student',
            'status' =>'inactive',
            'password' => Hash::make($request['password']),
        ]);

        verifyUser::create([
            'token'=>str::random(60),
            'user_id'=>$user->id,
        ]);

       Mail::to($user->email)->send(new verifyEmail($user));

       return redirect()->route('login')->with('success','Please Click On Tha Link Sent To Your Email.');



    }




     public function logout(Request $request)
    {
     
        Auth::logout();
        return redirect()->route('login');
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
    public function Forgetpassword(Request $request)
    {
        return view('auth.passwords.reset');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateForgetpassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = str_random(64);

      

        DB::table('password_resets')->insert(
          ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

          Mail::send('auth.passwords.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password Notification');
          });

            return back()->with('success', 'We have e-mailed your password reset link!');
        


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showResetPasswordForm($token) { 
         return view('auth.passwords.forgetPasswordLink', ['token' => $token]);
        }

       public function submitResetPasswordForm(Request $request)
        {
         if(\Request::isMethod('post')){
            
                  $request->validate([
                      'email' => 'required|email|exists:users',
                      'password' => 'required|string|min:6|confirmed',
                      'password_confirmation' => 'required'
                  ]);

            try{
          
                  $updatePassword = DB::table('password_resets')
                                      ->where([
                                        'email' => $request->email, 
                                        'token' => $request->token
                                      ])
                                      ->first();

          
                  if(!$updatePassword){
                      return redirect()->back()->with('msg', 'Invalid token!');
                  }
          
                  $user = User::where('email', $request->email)
                              ->update(['password' => Hash::make($request->password)]);
         
                  DB::table('password_resets')->where(['email'=> $request->email])->delete();

                  if(Auth::check()){
                    Auth::logout();
                  }
          
                  return redirect()->route('login')->with('msg', 'Your password has been changed!');

            }catch (\Exception $e) {
              
                return redirect()->back()->with('msg','Somthings Went Wrong!');
            }
        }else{



            toastr()->error('Opps!Something went wrong');
            return redirect()->back()->with('msg','Somthings Went Wrong!');

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
