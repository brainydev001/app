<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OTP;
use App\Models\Type;
use App\Models\Kin;

class OTPController extends Controller
{
    public function view($id)
    {
        return view('auth.otp_validation', compact(
            'id'
        ));
    }

    public function authenticate(Request $request, $id)
    {
        $otp = $request['otp'];

        $dbCheck = OTP::where([
            ['id', '=', $id]
        ])->pluck('otp')->first();

        if($dbCheck == $otp){
            $data = [
                'verified' => true
            ];
            $dbOtp = OTP::find($id);
            $dbOtp->update($data);
            return $this->authRedirect();
        }else{
            return redirect()->back()->with('error-message', 'OTP expired or does not match');
        }
    }

    // private function to redirect user based on type
    private function authRedirect()
    {
        // get user type id
        $user_type = auth()->user()->type_id;

        // using the id check on the types table
        $type = Type::find($user_type);
        $type_name = $type->display_name;

        // compare the major types and redirect accordingly
        if($type_name == 'Administrator'){
            return redirect('dashboard_index');
        }elseif($type_name == 'Farmer'){
            // check if farmer has registered kin
            $id = auth()->user()->id;
            $kin_check = Kin::where([
                ['user_id', '=', $id]
            ])->first();
            if($kin_check){
                return redirect('dashboard_farmer');
            }else{
                return redirect('kin');
            }
        };
    }
}
