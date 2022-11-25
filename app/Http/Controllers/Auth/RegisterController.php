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
        $userId = auth()->user()->id;
        $userOtp = $data['otp'];

        $this->otp($userId, $userOtp);

        // get user type id
        $user_type = auth()->user()->type_id;

        // using the id check on the types table
        $type = Type::find($user_type);
        $type_name = $type->display_name;

        // compare the major types and redirect accordingly
        if ($type_name == 'Administrator') {

            return 'dashboard_index' . auth()->user()->username;

        } elseif ($type_name == 'Farmer') {
    
            // check if farmer has registered kin
            $id = auth()->user()->id;
            $check = Kin::where([
                ['user_id', '=', $id]
            ])->first(); 
            if($check){
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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
            'email' => $data['email'],
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
    private function otp($userId, $userOtp)
    {
        
    }
    
}
