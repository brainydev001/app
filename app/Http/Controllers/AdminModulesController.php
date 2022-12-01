<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Activity;
use App\Models\Module;
use App\Models\Region;
use App\Models\User;
use App\Models\Type;
use App\Models\Budget;
use Illuminate\Support\Facades\DB;

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
        if ($type == 'Event') {
            $datas = Event::orderBy('id', 'desc')->get();
        } elseif ($type == 'Activity') {
            $datas = Activity::orderBy('id', 'desc')->get();
        } else {
            $modules = Module::orderBy('id', 'desc')->get();
            $relation_ids = [];
            foreach($modules as $data){
                array_push($relation_ids, $data->relation_id);
            }

            $relationModules = array_unique($relation_ids, SORT_REGULAR);
            $datas = [];
            foreach ($relationModules as $key=>$value) {
                $values = Module::where([
                    ['relation_id', '=', $value ]
                ])->first();
                array_push($datas, $values);
            }
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
        $staffId = Type::where([
            ['display_name', '=', 'Staff']
        ])->pluck('id')->first();
        $staffs = User::where([
            ['type_id', '=', $staffId]
        ])->get();
        $activites = Activity::all();
        $events = Event::all();
        $milestones = Module::all();

        return view('admin.modules.crud_module', compact(
            'type',
            'regions',
            'constituencies',
            'wards',
            'staffs',
            'activites',
            'events',
            'milestones'
        ))->with('success-message', 'Fill in the form inputs with relevant data and click on CREATE button to create a new ' . $type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        if ($type == 'Event') {
            Event::create($request->all());
        } elseif ($type == 'Activity') {
            Activity::create($request->all());
        }

        return redirect('module/' . $type)->with('success-message', $type . ' has been created. However you need to set up its BUDGET');
    }

    public function createModule(Request $request)
    {
        if ($request['event_id'] && $request['activity_id']) {
            foreach ($request['event_id'] as $event_id) {
                Module::create([
                    'name' => $request['file'],
                    'activity_id' => null,
                    'event_id' => $event_id,
                    'status' => 'Pending',
                    'relation_id' => $request['relation_id']
                ]);
            }

            foreach ($request['activity_id'] as $activity_id) {
                Module::create([
                    'name' => $request['file'],
                    'activity_id' => $activity_id,
                    'event_id' => null,
                    'status' => 'Pending',
                    'relation_id' => $request['relation_id']
                ]);
            }
        } elseif (!$request['event_id'] && $request['activity_id']) {
            foreach ($request['activity_id'] as $activity_id) {
                Module::create([
                    'name' => $request['file'],
                    'activity_id' => $activity_id,
                    'event_id' => null,
                    'status' => 'Pending',
                    'relation_id' => $request['relation_id']
                ]);
            }
        } elseif ($request['event_id'] && !$request['activity_id']) {
            foreach ($request['event_id'] as $event_id) {
                Module::create([
                    'name' => $request['file'],
                    'activity_id' => null,
                    'event_id' => $event_id,
                    'status' => 'Pending',
                    'relation_id' => $request['relation_id']
                ]);
            }
        } else {
            Module::create([
                'name' => $request['file'],
                'activity_id' => null,
                'event_id' => null,
                'status' => 'Pending',
                'relation_id' => $request['relation_id']
            ]);
        }

        return redirect()->back()->with('success-message', 'Module has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type)
    {
        if ($type == 'Event') {
            $events = Event::find($id);
            $data = $events;
            $budget = Budget::where([
                ['event_id', '=', $id]
            ])->get();

            return view('admin.modules.single_module', compact(
                'data',
                'type',
                'budget' 
            ));
        } elseif ($type == 'Activity') {
            $activities = Activity::find($id);
            $data = $activities;
            $budget = Budget::where([
                ['activity_id', '=', $id]
            ])->get();

            return view('admin.modules.single_module', compact(
                'data',
                'type',
                'budget'
            ));
        } else {
            $modules = Module::find($id);
            $data = $modules;
            $relation_id = $modules->relation_id;
            // related modules
            $groupMod = Module::where([
                ['relation_id', '=', $relation_id]
            ])->get();
            // activity list
            $activityList = [];
            // event list
            $eventList = [];

            foreach ($groupMod as $value) {
                if(isset($value->activity_id)){
                    $activity = $value->activity_id;
                    array_push($activityList, $activity);
                }elseif(isset($value->event_id)){
                    $event = $value->event_id;
                    array_push($eventList, $event);
                }
            }

            $activityData = [];
            $eventData = [];
            // get activity budget and items
            foreach($activityList as $id){
                $act = Activity::where([
                    ['id', '=', $id]
                ])->get();
                array_push($activityData, $act);    
                $actAmount = Budget::where([
                    ['activity_id', '=', $id]
                ])->sum('amount');
            }

            foreach($eventList as $id){
                $eve = Event::where([
                    ['id', '=', $id]
                ])->get();
                array_push($eventData, $eve);     
                $eveAmount = Budget::where([
                    ['event_id', '=', $id]
                ])->sum('amount');
            }
            if(isset($actAmount) && isset($eveAmount)){
                $amount = $actAmount + $eveAmount;
            }elseif(!isset($actAmount) && isset($eveAmount)){
                $actAmount = 0;
                $amount = $actAmount + $eveAmount;
            }elseif(isset($actAmount) && !isset($eveAmount)){
                $eveAmount = 0;
                $amount = $actAmount + $eveAmount;
            }

            return view('admin.modules.single_module', compact(
                'data',
                'type',
                'amount',
                'eventData',
                'activityData'
            ));
        }
        
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
