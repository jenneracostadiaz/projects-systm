<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mount' => 'required|numeric|min:0|max:100000',
            'description' => 'nullable|text',
            'status' => 'required|in:pending,approved,rejected',
            'client_id' => 'required|exists:clients,id',
        ];
    }

    public function messages(): array
    {
        return [
            'mount.required' => __('Mount is required'),
            'mount.numeric' => __('Mount must be a number'),
            'mount.min' => __('Mount must be at least 0'),
            'mount.max' => __('Mount must not exceed 100000'),
            'description.text' => __('Description must be a text'),
            'status.required' => __('Status is required'),
            'status.in' => __('Status must be one of: pending, approved, rejected'),
            'client_id.required' => __('Client ID is required'),
            'client_id.exists' => __('Client ID does not exist'),
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
