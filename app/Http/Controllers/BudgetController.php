<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Models\Budget;

class BudgetController extends Controller
{

    public function index()
    {
        $budgets = Budget::paginate(10);
        return $this->getResponse(true, 'Budgets retrieved successfully', $budgets);
    }

    public function store(BudgetRequest $request)
    {
        $budget = new Budget($request->input());
        $budget->save();
        return $this->getResponse(true, 'Budget created successfully', $budget);
    }

    public function show(Budget $budget)
    {
        return $this->getResponse(true, 'Budget retrieved successfully', $budget);
    }

    public function update(BudgetRequest $request, Budget $budget)
    {
        $budget->update($request->input());
        return $this->getResponse(true, 'Budget updated successfully', $budget);
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return $this->getResponse(true, 'Budget deleted successfully');
    }
}
