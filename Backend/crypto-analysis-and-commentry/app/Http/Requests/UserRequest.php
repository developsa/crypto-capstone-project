<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //RULES
    public function rules(): array
    {
        if (request()->isMethod('post')) {

            return [
                'name' => 'required|string|max:258',
                'email' => 'required|string',
                'password' => 'required|string'
            ];
        } else {
            return [
                'name' => 'required|string|max:258',
                'email' => 'required|string',
                'password' => 'required|string'
            ];
        }
    }
    public function messages(): array
    {
        if (request()->isMethod('post')) {
            return [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required'
            ];
        } else {
            return [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'password.required' => 'Password is required'
            ];
        }
    }
}
