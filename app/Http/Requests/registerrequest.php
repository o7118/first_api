<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

use function Laravel\Prompts\password;

class registerrequest extends FormRequest
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
            'name' => 'string|required',
            'email' => 'email|required|unique:users',
            'number'=>'string|required|unique:users|max:13',
            'password' => 'string|min:8'
        ];
    }
}
