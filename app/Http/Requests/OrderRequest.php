<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'nullable|string',
            'surname' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string',
            'address' => 'required|string',
            'currency' => 'required|string|exists:currencies,slug',
            'products' => 'required|array',
            'products.*' => 'required|integer|exists:products,id'
        ];
    }
}
