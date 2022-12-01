<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\User;
use App\Models\Region;
use App\Models\Budget;
use App\Models\Payment;
use App\Models\Module;
use DB;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        /**
         * Statistical analysis data objects.
         * Data from MYSQL database to be converted to objects and compacted.
         * Data sets are meant to define (var data) in chart js scripts and aid
         * in graphical visualization
         * */

        // farmers object
        $farmer = Type::where([
            ['display_name', '=', 'Farmer']
        ])->first();

        // check if farmer isset and access user one to one relationship
        if($farmer){
            $farmer = $farmer->id;
            $farmers = User::where([
                ['type_id', '=', $farmer],
                ['is_approved', '=', true]
            ])->get();
            $labels = $farmers->keys();
            $data = $farmers->values();
        }else{
            $farmers = '0';

        } 

        // Regions object
        $regions = Region::where([
            ['type', '=', 'Region']
        ])->get();

        // Age groups object
            // get farmer ages in ascending order 
        $ages = User::where([
            ['type_id', '=', $farmer],
            ['is_approved', '=', true]
        ])->orderBy('age', 'asc')->get(); 

        // budget object
        $budget = Budget::where([
            ['is_approved', '=', false]
        ])->get();

        // modules
        $modules = Payment::where([
            ['module_id', '!=', null],
            ['is_approved', '=', true]
        ])->count('amount');

        $all = Module::all();

        // users
        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->orderBy('id','ASC')
                    ->pluck('count', 'month_name');
 
        $labels = $users->keys();
        $data = $users->values();
       
        
        return view('admin.dashboard', compact(
            'farmers',
            'regions',
            'ages',
            'budget',
            'modules',
            'all',
            'data',
            'labels'
        ));
    }
}
