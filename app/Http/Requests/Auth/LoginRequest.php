<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [
            'login' => [
                'required',
                'string',
                'max:50',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],

            'remember' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    /**
     * Custom Validation Messages
     */
    public function messages(): array
    {
        return [
            'login.required' => 'Please enter your Login ID or Username.',

            'login.max' => 'Login ID or Username cannot exceed 50 characters.',

            'password.required' => 'Please enter your password.',

            'password.min' => 'Password must be at least 6 characters.',

            'password.max' => 'Password cannot exceed 255 characters.',
        ];
    }

    /**
     * Custom Attribute Names
     */
    public function attributes(): array
    {
        return [
            'login' => 'Login ID / Username',
        ];
    }
}