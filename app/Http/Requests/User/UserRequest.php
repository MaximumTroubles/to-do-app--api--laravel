<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'regex:/^[a-z]+$/i',
            ],
            'password' => 'required|min:3|max:8',
        ];
    }

    public function messages(): array
    {
        return [
        'name.regex' => 'Name must be with out numbers',
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getPassword(): string
    {
        return $this->input('password');
    }
}
