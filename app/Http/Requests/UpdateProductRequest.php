<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            "barcode" => [
                'required',
                'digits:13',
                Rule::unique('products', 'barcode')->ignore($this->route('product')),
            ],
            "sku" => [
                'required',
                'max:20',
                Rule::unique('products', 'sku')->ignore($this->route('product')),
            ],

            "name" => "required",
            "wholesale_price" => "required",
            "inventory_number" => "required",
            "category" => "required",
            "brand" => "required",
            "description" => "required",
        ];
    }

    public function messages()
    {
        return [
            'barcode.required' => 'Vui lòng nhập barcode',
            'barcode.unique' => 'Barcode đang trùng với sản phẩm khác',
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'sku.required' => 'Vui lòng nhập mã SKU',
            'sku.unique' => 'SKU đang trùng với sản phẩm khác',
            'wholesale_price.required' => 'Vui lòng nhập giá bán lẻ',
            'inventory_number.required' => 'Vui lòng nhập số lượng tồn kho',
            'category.required' => 'Vui lòng chọn danh mục',
            'brand.required' => 'Vui lòng chọn thương hiệu',
            'description.required' => 'Vui lòng nhập mô tả',
        ];
    }
}
