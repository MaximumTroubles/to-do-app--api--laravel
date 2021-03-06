<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'status' => 'required|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A title is required',
            'description.required' => 'A message is required',
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getDescription(): string
    {
        return $this->input('description');
    }

    public function getStatus(): string
    {
        return $this->input('status');
    }

    public function getUserId(): int
    {
        return $this->input('user_id');
    }
}
