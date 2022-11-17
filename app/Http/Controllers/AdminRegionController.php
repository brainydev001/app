<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Log;
use Carbon\Carbon;

class AdminRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        // get all data in regions table using eloquent and save it in a variable
        $type = $type;
        // get data from relevant table based on type
        if ($type == 'Region') {
            $datas = Region::where([
                ['type', '=', 'Region']
            ])->orderBy('id', 'desc')->get();
        } elseif ($type == 'Constituency') {
            $datas = Region::where([
                ['type', '=', 'Constituency']
            ])->orderBy('id', 'desc')->get();
        } else {
            $datas = Region::where([
                ['type', '=', 'Ward']
            ])->orderBy('id', 'desc')->get();
        }
        // resource to refer to membership types from types table and returned to a blade
        // data is passed as a variable
        return view('admin.regions.index', compact(
            'datas',
            'type'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $type)
    {
        // get user log
        $created_by = auth()->user()->first_name;

        // get origin details
        $origin = 'user region manager, create user region';

        // redirect to log private function with origin data
        $this->logs($origin, $created_by);

        //save membership type inputs from blade to types table
        $data = [
            'name' => $request['name'],
            'type' => $type,
            'created_by' => auth()->user()->id
        ];

        // using eloquent to access create method
        $region_create = Region::create($data);

        // check for error and display message
        if ($region_create) {
            return redirect('region/'.$type)->with('success-message', 'Region Has Been Created Successfully!!');
        } else {
            return redirect('region/'.$type)->with('warning-message', 'Oops Region Has NOT been Created. Please try again !!');
        }
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
    public function destroy($id, $type)
    {
        //get membership type from types table using id
        $region = Region::find($id);

        // use eloquent to access delete method
        $region->delete();

        // redirect to relevant blade
        return redirect('region/'.$type)->with('success-message', 'Region Has Been Deleted Successfully!!');
    }

    // reusable private functions
    // user logs
    private function logs($origin, $created_by)
    {
        // get current time
        $mytime = Carbon::now();
        $time = $mytime->toDateTimeString();

        // save log data to logs table
        $data = [
            'origin' => $created_by . ' accessed ' . $origin . ' at ' . $time,
            'user_id' => auth()->user()->id
        ];

        // create new entry in logs table
        Log::create($data);
    }
}
