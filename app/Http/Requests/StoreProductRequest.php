<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "barcode" => "required|digits:13s|unique:products,barcode",
            "name" => "required",
            "wholesale_price" => "required",
            "inventory_number" => "required",
            "category" => "required",
            "featured_image" => "required",
            "description" => "required",
        ];
    }

    /**
     * custom message rules
     *
     * @return array
     */
    public function messages()
    {
        return [
            'barcode.required' => 'Vui lòng nhập barcode',
            'name.required' => 'Vui lòng nhập tên danh mục',
        ];
    }
}
