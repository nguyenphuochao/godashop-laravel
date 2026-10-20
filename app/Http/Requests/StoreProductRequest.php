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
            "barcode" => "required|digits:13|unique:products,barcode",
            "sku" => "required|max:20|unique:products,sku",
            "name" => "required",
            "wholesale_price" => "required",
            "inventory_number" => "required",
            "category" => "required",
            "brand" => "required",
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
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'sku.required' => 'Vui lòng nhập mã SKU',
            'wholesale_price.required' => 'Vui lòng nhập giá bán lẻ',
            'inventory_number.required' => 'Vui lòng nhập số lượng tồn kho',
            'category.required' => 'Vui lòng chọn danh mục',
            'brand.required' => 'Vui lòng chọn thương hiệu',
            'featured_image.required' => 'Vui lòng hình ảnh',
            'description.required' => 'Vui lòng nhập mô tả',
        ];
    }
}
