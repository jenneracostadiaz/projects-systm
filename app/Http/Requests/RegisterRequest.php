<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('Name is required'),
            'name.string' => __('Name must be a string'),
            'name.max' => __('Name must not exceed 100 characters'),
            'email.required' => __('Email is required'),
            'email.email' => __('Email must be a valid email address'),
            'email.unique' => __('Email is already in use'),
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
