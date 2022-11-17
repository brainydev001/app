<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kin;

class KinController extends Controller
{
    // get kin registration blade
    public function index()
    {
        return view('kin.registration');
    }

    // store kin data in kin table
    public function create(Request $request, $id)
    {
        // declare all data to be stored
        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'id_number' => $request['id_number'],
            'user_id' => $id
        ];

        // store data in kin table
        Kin::create($data);

        // redirect to farmer dashboard
        return redirect('dashboard_farmer')->with('info-message', 'Registration has been successfull. Contact admin to have access to modules, events and activities');

    }
}
