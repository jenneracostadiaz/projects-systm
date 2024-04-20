<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Models\Budget;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgets = Budget::paginate(10);
        return response()->json($budgets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BudgetRequest $request)
    {
        $budget = new Budget($request->input());
        $budget->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'Budget created successfully',
                'data' => $budget
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        return response()->json([
            'status' => true,
            'data' => $budget
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BudgetRequest $request, Budget $budget)
    {
        $budget->update($request->input());
        return response()->json(
            [
                'status' => true,
                'message' => 'Budget updated successfully',
                'data' => $budget
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'Budget deleted successfully',
            ]
        );
    }
}
