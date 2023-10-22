<?php

namespace App\Http\Requests\Profile;

use App\Traits\WithApiValidationError;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    use WithApiValidationError;

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
            'email'         => ['required' ,'email', Rule::unique('users', 'email')->ignore($this->user()->id, 'id')],
            'name'          => 'required|string|min:3|max:255',
            'address'       => 'required|string|min:5',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'gender_id'     => 'required|numeric|in:1,2',
            'bio'           => 'nullable|string|min:5',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
