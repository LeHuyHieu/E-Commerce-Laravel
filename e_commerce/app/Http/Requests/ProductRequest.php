<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|min:5|max:255',
            'category_id' => 'required|numeric',
            'product_type' => 'required|string',
            'description' => 'required|min:5',
            'image_before' => 'mimes:jpeg,jpg,png,gif,svg|required|max:10000',
            'image_after' => 'mimes:jpeg,jpg,png,gif,svg|required|max:10000',
            'price' => 'required',
            'quantity' => 'required|numeric',
            'list_image' => 'required|array',
            'discount_percent' => 'numeric|nullable',
            'time_sale' => 'nullable|date_format:Y-m-d\TH:i'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute phải nhỏ hơn :min',
            'max' => ':attribute phải nhỏ hơn :max',
            'numeric' => ':attribute không được là chuỗi',
            'mimes' => ':attribute không được khác kiểu :mimes',
            'date_format' => ':attribute không được khác kiểu Y-m-d H:i:s',
            'string' => ':attribute không được là số'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên',
            'category_id' => 'Danh mục',
            'product_type' => 'Loại sản phẩm',
            'description' => 'Mô tả',
            'image_before' => 'Ảnh trước',
            'image_after' => 'Ảnh sau',
            'price' => 'Giá',
            'quantity' => 'Số lượng',
            'list_image' => 'Ảnh chi tiết',
            'discount_percent' => 'Phần trăm giảm giá',
            'time_sale' => 'Thời gian giảm giá',
        ];
    }
}
