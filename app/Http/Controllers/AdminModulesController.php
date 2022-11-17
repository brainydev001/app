<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Activity;
use App\Models\Module;
use App\Models\Region;

class AdminModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $type = $type;
        // get data from relevant table based on type
        if($type == 'Event'){
            $datas = Event::orderBy('id', 'desc')->get();
        }elseif($type == 'Activity'){
            $datas = Activity::orderBy('id', 'desc')->get();
        }else{
            $datas = Module::orderBy('id', 'desc')->get();
        }

        //redirect to modules index blade compacting datas variable
        return view('admin.modules.index', compact(
            'datas',
            'type'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        //return to relevant blade based on type
        $type = $type;
        $regions = Region::where([
            ['type', '=', 'Region']
        ])->get();
        $constituencies = Region::where([
            ['type', '=', 'Constituency']
        ])->get();
        $wards = Region::where([
            ['type', '=', 'Ward']
        ])->get();

        return view('admin.modules.crud_module', compact(
            'type',
            'regions',
            'constituencies',
            'wards'
        ))->with('success-message', 'Fill in the form inputs with relevant data and click on CREATE button to create a new '.$type);

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
