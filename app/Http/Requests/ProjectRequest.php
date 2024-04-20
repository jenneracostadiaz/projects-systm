<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'nullable|string',
            'start_date' => 'nullable|date|before:end_date|after:current_date',
            'end_date' => 'nullable|date|after:start_date|after:current_date',
            'status' => 'required|in:pending,approved,finished,rejected',
            'client_id' => 'required|exists:clients,id',
            'budget_id' => 'required|exists:budgets,id',
        ];
    }

    public function messages(): array
    {
        return [
            'description.string' => __('Description must be a string'),
            'start_date.date' => __('Start date must be a valid date'),
            'start_date.before' => __('Start date must be before end date'),
            'start_date.after' => __('Start date must be after current date'),
            'end_date.date' => __('End date must be a valid date'),
            'end_date.after' => __('End date must be after start date'),
            'end_date.after' => __('End date must be after current date'),
            'status.required' => __('Status is required'),
            'status.in' => __('Status must be one of: pending, approved, finished, rejected'),
            'client_id.required' => __('Client ID is required'),
            'client_id.exists' => __('Client ID does not exist'),
            'budget_id.required' => __('Budget ID is required'),
            'budget_id.exists' => __('Budget ID does not exist'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ], 422));
    }
}
