<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống',
            'integer' => ':attribute phải là số'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm',
            'image' => 'Ảnh sản phẩm',
            'description' => 'Mô tả sản phấm',
        ];
    }

    //
    public function after(): array
    {
        return [
            function (Validator $validator) {
                // dd($validator);
                // if ($this->somethingElseIsInvalid()) {
                //     $validator->errors()->add(
                //         'field',
                //         'Something is wrong with this field!'
                //     );
                // }
            }
        ];
    }

    // xử lý sau khi mà validate
    protected function prepareForValidation(): void
    {
        $this->merge([
            'created_ad' => date('Y-m-d H:i-s'),
            'slug' => Str::slug($this->name)
        ]);
    }
}
