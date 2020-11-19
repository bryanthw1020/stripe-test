<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PaymentIntentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required|string|bail',
            'amount' => 'required|numeric|min:0|bail',
            'currency' => 'required|string|max:3|bail',
            'return_url' => 'required|url|bail',
            'callback_url' => 'required|url|bail',
            'meta' => 'nullable|json|bail'
        ];
    }
}
