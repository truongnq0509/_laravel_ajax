<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'avatar' => 'required',
            'role_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            // 'required' => ':attribute bắt bộc',
            // 'integer' => ':attribute phải là số',
            // 'unique' => ':attribute đã tồn tại'
        ];
    }

    public function attributes()
    {
        return [];
    }


    public $validator = null;
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
