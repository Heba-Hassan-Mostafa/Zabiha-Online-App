<?php

namespace App\Http\Requests\Products;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'             => 'required|max:255',
            'description'      => 'sometimes|nullable',
            'image'            => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif,bmp,webp,svg',
            'main_price'       => 'required',
            'discount_price'   => 'sometimes|nullable',
            'store_quantity'   => 'required',
            'status'           => 'required',
            'category_id'      => 'required',
            'city_id'          => 'required',


        ];
    }
}
