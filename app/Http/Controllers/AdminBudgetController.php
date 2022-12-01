<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;

class AdminBudgetController extends Controller
{
    public function index($type, $id)
    {
        $expenses = Expense::orderBy('id', 'desc')->get();
        if ($type == 'Event') {
            $budgets = Budget::where([
                ['event_id', '=', $id]
            ])->get();
            $amount = Budget::where([
                ['event_id', '=', $id]
            ])->sum('amount');
        } elseif ($type == 'Activity') {
            $budgets = Budget::where([
                ['activity_id', '=', $id]
            ])->get();
            $amount = Budget::where([
                ['activity_id', '=', $id]
            ])->sum('amount');
        }
        return view('admin.budget.index',compact(
            'type',
            'id',
            'expenses',
            'budgets',
            'amount'
        ));
    }

    public function requisition(Request $request, $type, $id)
    {
        if($type == 'Event'){
            $requisition = explode(',', $request['requsition_note']);
            Budget::create([
                'amount' => $requisition[0],
                'estimated_budget' => $request['estimated_amount'],
                'requsition_note' => $requisition[1],
                'examination_note' => 'Pending Examination',
                'event_id' => $id,
                'relation_id' => $id,
                'created_by' => auth()->user()->id
            ]);
        }elseif($type == 'Activity'){
            $requisition = explode(',', $request['requsition_note']);
            Budget::create([
                'amount' => $requisition[0],
                'estimated_budget' => '0',
                'requsition_note' => $requisition[1],
                'examination_note' => 'Pending Examination',
                'relation_id' => $id,
                'activity_id' => $id,
                'created_by' => auth()->user()->id
            ]);
        }

        return redirect()->back()->with('success-message', 'Request has been successfully made');
    }

    public function removeBudget($id, $type)
    {
        
        if ($type == 'Event') {
            $budget = Budget::where([
                ['event_id', '=', $id]
            ])->first();
        } elseif ($type == 'Activity') {
            $budget = Budget::where([
                ['activity_id', '=', $id]
            ])->first();
        }
        $budget->delete();

        return redirect()->back()->with('success-message', 'Request has been removed successfully');
    }
}
