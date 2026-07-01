<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRetailerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
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

            'username' => [
                'required',
                'string',
                'max:50',
                'unique:users,username',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],

            'shop_name' => [
                'required',
                'string',
                'max:150',
            ],

            'owner_name' => [
                'required',
                'string',
                'max:150',
            ],

            'mobile' => [
                'required',
                'digits:10',
                'unique:retailers,mobile',
            ],

            'alternate_mobile' => [
                'nullable',
                'digits:10',
            ],

            'email' => [
                'nullable',
                'email',
                'unique:users,email',
            ],

            'address' => [
                'required',
            ],

            'city' => [
                'required',
                'max:100',
            ],

            'state' => [
                'required',
                'max:100',
            ],

            'pincode' => [
                'required',
                'digits:6',
            ],

            'margin' => [
                'required',
                'numeric',
                'min:0',
            ],

            'daily_limit' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [

            'username.required' => 'Username is required.',

            'password.confirmed' => 'Passwords do not match.',

            'mobile.digits' => 'Mobile number must be 10 digits.',

            'pincode.digits' => 'Pincode must be 6 digits.',

        ];
    }
}