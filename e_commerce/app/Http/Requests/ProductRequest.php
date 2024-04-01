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
        $rules = [
            'name' => 'required|min:5|max:255',
            'category_id' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'product_type' => 'required|string',
            'description' => 'required|min:5',
            'price' => 'required',
            'product_variants' => 'required|array',
            'additional_infos' => 'required|array',
            'discount_percent' => 'numeric|nullable',
            'time_sale' => 'nullable|date_format:Y-m-d\TH:i',
        ];
        if ($this->isMethod('post')) {
            $rules['image_before'] = 'mimes:jpeg,jpg,png,gif,svg,webp|required|max:10000';
            $rules['image_after'] = 'mimes:jpeg,jpg,png,gif,svg,webp|required|max:10000';
            $rules['list_image'] = 'required|array';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            if ($this->hasFile('image_before')) {
                $rules['image_before'] = 'mimes:jpeg,jpg,png,gif,svg,webp|max:10000';
            }

            if ($this->hasFile('image_after')) {
                $rules['image_after'] = 'mimes:jpeg,jpg,png,gif,svg,webp|max:10000';
            }

            if ($this->hasFile('list_image')) {
                $rules['list_image'] = 'required|array';
            }

            $rules['index_image_variant'] = 'nullable|array';
            $rules['index_list_image'] = 'nullable|array';
        }
        return $rules;
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
            'product_variants' => 'Sản phẩm chi tiết',
            'list_image' => 'Ảnh chi tiết',
            'discount_percent' => 'Phần trăm giảm giá',
            'time_sale' => 'Thời gian giảm giá',
        ];
    }
}
