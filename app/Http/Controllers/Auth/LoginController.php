<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\Kin;
use App\Models\OTP;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        // otp check
        $id = auth()->user()->id;
        $check = OTP::where([
            ['user_id', '=', $id],
            ['verified', '=', false]
        ])->latest()->first();

        // otp id
        $otpId = OTP::where([
            ['user_id', '=', $id],
            ['verified', '=', false]
        ])->pluck('id')->first();
        
        // using the id check on the types table
        // get user type id
        $user_type = auth()->user()->type_id;
        $type = Type::find($user_type);
        $type_name = $type->display_name;

        // display otp sign in form
        if($check){
            return 'otpValidate/'.$otpId . auth()->user()->username;
        }elseif(!$check && $type_name == 'Administrator'){
            // compare the major types and redirect accordingly
            return 'dashboard_index' . auth()->user()->username;
        }elseif(!$check && $type_name == 'Farmer'){
            // check if farmer has registered kin
            $id = auth()->user()->id;
            $kin_check = Kin::where([
                ['user_id', '=', $id]
            ])->first();
            if($kin_check){
                return 'dashboard_farmer' . auth()->user()->username;
            }else{
                return 'kin' . auth()->user()->username;
            }
        };
    
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // use phone number to login
    public function username(){
        return 'phone_number';
    }

    /**
     * Logout redirect
     */
    public function logout(Request $request) {
        auth()->logout();
        return redirect('/login')->with('info-message','You are logged out. Login to continue');
    }

}
