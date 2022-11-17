<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Log;
use Carbon\Carbon;

class AdminMemberTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data in types table using eloquent and save it in a variable
        $types = Type::all();

        // resource to refer to membership types from types table and returned to a blade
        // data is passed as a variable
        return view('admin.types.index',compact(
            'types'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // get user log
        $created_by = auth()->user()->first_name;

        // get origin details
        $origin = 'user type manager, create user type';

        // redirect to log private function with origin data
        $this->logs($origin, $created_by);

        //save membership type inputs from blade to types table
        $data = [
            'display_name' => $request['display_name'],
            'description' => $request['description'],
            'designation' => $request['designation'],
            'created_by' => auth()->user()->id
        ];
 
        // using eloquent to access create method
        $type_create = Type::create($data);

        // check for error and display message
        if ($type_create) {
            return redirect('type_index')->with('success-message', 'Membership Type Has Been Created Successfully!!');
        } else {
            return redirect('type_index')->with('warning-message', 'Oops Membership Type Has NOT been Created. Please try again !!');
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
    public function destroy($id)
    {
        //get membership type from types table using id
        $type = Type::find($id);

        // use eloquent to access delete method
        $type->delete();

        // redirect to relevant blade
        return redirect('type_index')->with('success-message', 'Membership Type Has Been Deleted Successfully!!');

    }

    // reusable private functions
    // user logs
    private function logs($origin, $created_by)
    {
        // get current time
        $mytime = Carbon::now();
        $time =$mytime->toDateTimeString();
        
        // save log data to logs table
        $data = [
            'origin' => $created_by.' accessed '.$origin.' at '.$time,
            'user_id' => auth()->user()->id
        ];
        
        // create new entry in logs table
        Log::create($data);
    }
}
