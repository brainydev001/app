<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        // get user by type
        
        // get farmers
        $farmer = Type::where([
            ['display_name', '=', 'Farmer']
        ])->first();

        // check if farmer isset and access user one to one relationship
        if($farmer){
            $farmer = $farmer->id;
            $user_farmer = User::where([
                ['type_id', '=', $farmer]
            ])->get();
        }else{
            $user_farmer = '0';

        }

        // get staff
        $staff = Type::where([
            ['display_name', '=', 'Staff']
        ])->first();
        // check if farmer isset and access user one to one relationship
        if($staff){
            $staff = $staff->id;
            $user_staff = User::where([
                ['type_id', '=', $staff]
            ])->get();
        }else{
            $user_staff = '0';
        }

        // get Administrator
        $Administrator = Type::where([
            ['display_name', '=', 'Administrator']
        ])->first();
        // check if farmer isset and access user one to one relationship
        if($Administrator){
            $Administrator = $Administrator->id;
            $user_Administrator = User::where([
                ['type_id', '=', $Administrator]
            ])->get();
        }else{
            $user_Administrator = '0';
        }

       
        
        return view('admin.dashboard', compact(
            'user_farmer',
            'user_staff',
            'user_Administrator'
        ));
    }
}
