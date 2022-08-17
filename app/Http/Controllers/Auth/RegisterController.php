<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\verifyUser;
use App\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function verifyEmail($token){

        $verifiedUser = verifyUser::where('token',$token)->first();
        if(isset($verifiedUser)){
            $user = $verifiedUser->User;

            if(!$user->email_verified_at){
                $user->email_verified_at=Carbon::now();
                $user->save();
                return \redirect(route('login'));
            }else{
                 return \redirect()->back();
            }
        }else{
            return \redirect(route('login'));
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['email']){
               return Validator::make($data, [
                    'email' => ['string', 'email', 'unique:users,email'],
                ]);
            }


        return Validator::make($data, [
            'username' => ['required', 'string', 'min:5','unique:users,user_name'],
            'mobile' =>['required','numeric','min:11','regex:/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required_with:password|same:password|min:6'],
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $unique_id = "B".mt_rand(1000, 9999);
        return User::create([
            'unique_id' => $unique_id.Carbon::now()->second,
            'user_name' => $data['username'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'role' =>'student',
            'status' =>'inactive',
            'password' => Hash::make($data['password']),
        ]);

        verifyUser::create([
            'token'=>srt::random(60),
            'user_id'=>$user->id,
        ]);

       Mail::to($user->email)->send(new verifyEmail($user));



    }


}
