<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGameRequest extends FormRequest
{
    /**
     * Authorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules
     */
    public function rules(): array
    {
        $game = $this->route('game');

        return [

            'game_type_id' => [
                'required',
                'exists:game_types,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('games', 'name')->ignore($game->id),
            ],

            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('games', 'code')->ignore($game->id),
            ],

            'open_time' => [
                'required',
            ],

            'close_time' => [
                'required',
            ],

            'result_time' => [
                'required',
            ],

            'min_bid' => [
                'required',
                'numeric',
                'min:0',
            ],

            'max_bid' => [
                'required',
                'numeric',
                'gte:min_bid',
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
            'round_duration' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:1440',
                ],

        ];
    }

    /**
     * Prepare Data
     */
    protected function prepareForValidation(): void
    {
        $this->merge([

            'name' => trim($this->name),

            'code' => strtoupper(trim($this->code)),

        ]);
    }
}