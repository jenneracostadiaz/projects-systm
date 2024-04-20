<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mount' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'client_id' => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ],
                422
            );
        }

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
    public function update(Request $request, Budget $budget)
    {

        $validator = Validator::make($request->all(), [
            'mount' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'client_id' => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ],
                422
            );
        }

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
