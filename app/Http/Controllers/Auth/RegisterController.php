<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Region;
use App\Models\Type;
use App\Models\Kin;
use Carbon\Carbon;
use App\Models\OTP;
use Illuminate\Support\Facades\Http;

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
    // protected $redirectTo ='dashboard_index';
    public function redirectTo()
    {
        // randomize a number between 10 -1000
        $digits = 5;
        $randomNumber = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        // create user one time password
        $data = [
            'user_id' => auth()->user()->id,
            'otp' => $randomNumber,
            'verified' => false
        ];

        // save otp data to otp table
        $otp = OTP::create($data);

        // send otp to user

        // user variables
        $auth = auth()->user();
        $userphone = auth()->user()->phone_number;
        $userOtp = $otp->otp;

        // send otp to user

        $this->otp($auth, $userphone, $userOtp);

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
        $this->middleware('guest');
    }

    // override show register to pass in variables
    public function showRegistrationForm()
    {
        $types = Type::all();
        $regions = Region::where([
            ['type', '=', 'Region']
        ])->orderBy('id', 'desc')->get();
        $constituencies = Region::where([
            ['type', '=', 'Constituency']
        ])->orderBy('id', 'desc')->get();
        $wards = Region::where([
            ['type', '=', 'Ward']
        ])->orderBy('id', 'desc')->get();

        return view('auth.register', compact(
            'types',
            'regions',
            'constituencies',
            'wards'
        ));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:25', 'unique:users'],
            'age' => ['required'],
            'gender' => ['required'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'county' => ['required', 'string', 'max:255'],
            'sub_county' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'integer'],
            'region_id' => ['required', 'integer'],
            'constituency_id' => ['required', 'integer'],
            'ward_id' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // handling images using sym link method
        $path = $data['photo']->store('user');

        // handle creating the age using carbon
        $age = explode('-', $data['age'])[0];
        $today = Carbon::now();
        $year = $today->year;
        $age =(int)$year - (int)$age;

        // create O.T.P

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'age' => $age,
            'gender' => $data['gender'],
            'county' => $data['county'],
            'sub_county' => $data['sub_county'],
            'region_id' => $data['region_id'],
            'constituency_id' => $data['constituency_id'],
            'ward_id' => $data['ward_id'],
            'photo' => $path,
            'type_id' => $data['type_id'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // private function to send user the otp
    private function otp($auth, $userphone, $userOtp)
    {
        $phone = explode('0' , $userphone)[1];

        // sms dynamic content
        $phone_value = '254'.$phone;
        $otp_value = $userOtp;
        
        // message content
        $message ='Your one time password valid for 24hours is '.$otp_value.'. Login in and use the O.T.P to access your dashboard.';
        
        // send otp to user phone number
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://smsportal.hostpinnacle.co.ke/SMSApi/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "userid=Pafid&password=xxxxx&sendMethod=quick&mobile=".$phone_value."&msg=".$message."&senderid=HPKSMS&msgType=text&duplicatecheck=true&output=json",
            CURLOPT_HTTPHEADER => array(
                "apikey: 14e9d08f986cdac9422769a9047d591e43313c43",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }

    }

}
