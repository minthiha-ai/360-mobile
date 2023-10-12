<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $limit      = ($this->old) ? 10 - count($this->old) : 10;
        $img_status = ($this->old) ? 'nullable' : 'required';

        return [
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'size' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'detail' => 'required',

            'images'   => "nullable|array|min:1|max:$limit",
            'images.*' => "nullable|mimes:jpg,jpeg,png,JPEG,PNG,JPG|max:3072",
        ];
    }
}
