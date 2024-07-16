<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresencePostRequest extends FormRequest
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
            "session" => "required|numeric",
            "location" => "required|string|max:64",
            "present_date" => "required|string|max:16",
            "status" => "numeric",
        ];
    }
}
