<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('Email is required'),
            'email.email' => __('Email must be a valid email address'),
            'email.max' => __('Email must not exceed 100 characters'),
            'password.required' => __('Password is required'),
            'password.string' => __('Password must be a string'),
            'password.min' => __('Password must be at least 6 characters'),
            'password.max' => __('Password must not exceed 100 characters'),
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
