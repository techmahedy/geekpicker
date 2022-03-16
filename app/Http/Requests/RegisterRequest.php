<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

    public function rules()
    {
        return [
            'currency_id' => 'required|numeric',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'currency_id' => 'Currency is required field!',
            'name.required' => 'Name is required field!',
            'name.required' => 'Email is required field!',
            'password.required' => 'Password is required!',
            'c_password.required' => 'Password and confirm password must be same!'
        ];
    }
}
