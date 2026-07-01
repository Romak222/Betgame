<?php

namespace App\Http\Requests\Retailer;

use Illuminate\Foundation\Http\FormRequest;

class PlaceBetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'game_round_id' => [
                'required',
                'exists:game_rounds,id'
            ],

            'selection' => [
                'required',
                'digits:1'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:10'
            ],

        ];
    }
}