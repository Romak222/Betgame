<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRetailerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $retailer = $this->route('retailer');

        return [

            'username' => [
                'required',
                'max:50',
                Rule::unique('users', 'username')->ignore($retailer->user_id),
            ],

            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($retailer->user_id),
            ],

            'password' => [
                'nullable',
                'confirmed',
                'min:6',
            ],

            'shop_name' => 'required|max:255',

            'owner_name' => 'required|max:255',

            'mobile' => [
                'required',
                Rule::unique('retailers', 'mobile')->ignore($retailer->id),
            ],

            'alternate_mobile' => 'nullable',

            'address' => 'required',

            'city' => 'required',

            'state' => 'required',

            'pincode' => 'required',

            'margin' => 'required|numeric|min:0',

            'daily_limit' => 'required|numeric|min:0',

            'status' => 'required|boolean',

            'notes' => 'nullable',
        ];
    }
}