<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGameTypeRequest extends FormRequest
{
    /**
     * Authorize the request.
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
        $gameType = $this->route('game_type');

        return [

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('game_types', 'name')->ignore($gameType->id),
            ],

            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('game_types', 'code')->ignore($gameType->id),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }

    /**
     * Prepare data before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([

            'code' => strtoupper(trim($this->code)),

            'name' => trim($this->name),

        ]);
    }
}