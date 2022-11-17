<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FarmerDashboardController extends Controller
{
    //get farmer dashboard
    public function index()
    {
        return view('farmer.dashboard');
    }
}
