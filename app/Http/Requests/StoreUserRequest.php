<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // rules for regsistering
            // name is required and must be string and should not be more than 255 characters
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "max:255", "unique:users"], // unique on users table
            "password" => ["required", "confirmed", Rules/Password::defaults]
        ];
    }
}