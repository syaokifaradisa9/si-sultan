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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email|unique:user_divisions,email',
            'password' => 'required',
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Masukkan email yang valid',
            'email.unique' => 'Silahkan gunakan email yang lain',
            'password.required' => 'Password tidak boleh kosong',
            'role' => 'Role tidak boleh kosong'
        ];
    }
}
