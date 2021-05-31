<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'status' => 'required|min:3|max:6',
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
}
