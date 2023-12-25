<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string|max:100',
            'user_username' => 'required|string|max:50|unique:users',
            'user_phonenumber' => 'required|string|max:13|unique:users',
            'user_email' => 'required|string|email|max:150|unique:users',
            'user_password' => 'required|string|min:8|max:255',
        ];
    }
}
