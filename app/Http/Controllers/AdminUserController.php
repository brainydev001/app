<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kin;
use App\Models\Type;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        // Dynamic IP address
        // $ip = $user_id->ip();
        // $currentUserInfo = Location::get($ip);

        // set variables
        $type = $type;

        // get staff type row from types table
        $staff_id = Type::where([
            ['display_name', '=', 'Staff']
        ])->pluck('id')->first();

        // get farmer row from types table
        $farmer_id = Type::where([
            ['display_name', '=', 'Farmer']
        ])->pluck('id')->first();


        //check for null variables and get user based on type and return a users variable
        if ($type == 'farmer' && $farmer_id != null ) {
            $users = User::where([
                ['type_id', '=', $farmer_id]
            ])->orderBy('id', 'desc')->get();
        } elseif ($type == 'staff' && $staff_id != null) {
            $users = User::where([
                ['type_id', '=', $staff_id]
            ])->orderBy('id', 'desc')->get();
        } elseif ($type == 'kin') {
            $users = Kin::orderBy('id', 'desc')->get();
        }else{
            $users = null;
        }

        
        return view('admin.users.user_type', compact(
            'users',
            'type'
        ));
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
