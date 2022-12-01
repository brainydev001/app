<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::orderBy('id', 'desc')->get();
        return view('admin.expenses.index', compact(
            'expenses'
        ));
    }

    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $data =[
            'name' => $request['name'],
            'type' => $request['type'],
            'expense_note' => $request['note'],
            'amount' => $request['amount'],
            'estimated_amount' => $request['amount'],
            'deviation' => 0,
            'examination_note' => 'Pending Approval',
        ];

        Expense::create($data);
        return redirect()->back();
    }
}
