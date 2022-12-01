<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Event;
use App\Models\Module;
use App\Models\Budget;
use Illuminate\Http\Request;

class QueryManagerController extends Controller
{
    public function index()
    {
        return view('admin.queries.index');
    }

    public function show($type)
    {
        if($type == 'activity'){
            $queries = Activity::where([
                ['is_approved', '=', false]
            ])->get();
            $amounts = [];
            
            foreach($queries as $query)
            {
                $eventActivity = Budget::where([
                    ['event_id', '=', $query->id]
                ])->sum('amount');
                array_push($amounts, $eventActivity);
            }
        }elseif($type == 'event'){
            $queries = Event::where([
                ['is_approved', '=', false]
            ])->get();
            $amounts = [];
           
            foreach($queries as $query)
            {
                $eventBudget = Budget::where([
                    ['event_id', '=', $query->id]
                ])->sum('amount');
                array_push($amounts, $eventBudget);
            }
        }elseif($type == 'module'){
            $queries = Module::where([
                ['is_approved', '=', false]
            ])->get();
        }

        return view('admin.queries.list', compact(
            'queries',
            'type',
            'amounts'
        ));
    }

    public function approvePage($id, $type)
    {
        if ($type == 'event') {
            $events = Event::find($id);
            $data = $events;
            $budget = Budget::where([
                ['event_id', '=', $id]
            ])->sum('amount');
            $requisition = Budget::where([
                ['event_id', '=', $id]
            ])->get();
        } elseif ($type == 'activity') {
            $activities = Activity::find($id);
            $data = $activities;
            $budget = Budget::where([
                ['activity_id', '=', $id]
            ])->sum('amount');
            $requisition = Budget::where([
                ['activity_id', '=', $id]
            ])->get();
        }
        
        return view('admin.queries.approve', compact(
            'data',
            'type',
            'budget',
            'requisition'
        ));
    }

    public function approveRequest($type, $id)
    {
        if ($type == 'event') {
            $requisition = Budget::find($id);
            $data = [
                'is_approved' => true,
                'approved_by' => auth()->user()->id,
                'examination_note' => 'Approved'
            ];
            $requisition->update($data);
        } elseif ($type == 'activity') {
            $requisition = Budget::find($id);
            $data = [
                'is_approved' => true,
                'approved_by' => auth()->user()->id,
                'examination_note' => 'Approved'
            ];
            $requisition->update($data);
        }

        return redirect()->back()->with('success-message', 'Approved');
    }

    public function rejectRequest($type, $id)
    {
        if ($type == 'event') {
            $requisition = Budget::find($id);
            $data = [
                'is_approved' => false,
                'approved_by' => auth()->user()->id,
                'examination_note' => 'Approved'
            ];
            $requisition->update($data);
        } elseif ($type == 'activity') {
            $requisition = Budget::find($id);
            $data = [
                'is_approved' => false,
                'approved_by' => auth()->user()->id,
                'examination_note' => 'Approved'
            ];
            $requisition->update($data);
        }

        return redirect()->back()->with('success-message', 'Request has been rejected');
    }

    public function amendRequest(Request $request, $type, $id)
    {
        if ($type == 'event') {
            $requisition = Budget::find($id);
            $requisition->update($request->all());
        } elseif ($type == 'activity') {
            $requisition = Budget::find($id);
            $requisition->update($request->all());
        }

        return redirect()->back()->with('success-message', 'Request has been ammended');
    }
}
