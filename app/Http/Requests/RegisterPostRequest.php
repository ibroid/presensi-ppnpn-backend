<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
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
            "name" => "required|string|max:64",
            "employee_id" => "required|numeric",
            "password" => "required|string|max:64|min:3",
            "identifier" => "required|string|max:16|unique:users,identifier|min:3",
        ];
    }

    public function messages()
    {
        return [
            "password.min" => "Password Minimal :min karakter",
            "password.max" => "Password Maksimal :max karakter",
            "name.max" => "Nama Maksimal :max karakter",
            "identifier.max" => "Nomor Telepon Maksimal :max karakter",
            "identifier.min" => "Nomor Telepon Minimal :min karakter",
        ];
    }
}
