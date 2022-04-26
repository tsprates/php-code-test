<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'required',
            'address.number' => 'required|integer|min:1',
            'address.street' => 'required|min:1',
            'address.city' => 'required|min:2',
            'address.state' => 'required|min:2',
            'address.country' => 'required|min:2',
        ];
    }
}
