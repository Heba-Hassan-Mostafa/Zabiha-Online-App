<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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

        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'file_name'            => 'required|image|mimes:png,jpg,jpeg,gif,bmp,webp,svg',
                    'url'                  => 'sometimes|nullable',
                    'status'               => 'required',
                    'product_id'           => 'required',

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'file_name'            => 'image|mimes:png,jpg,jpeg,gif,bmp,webp,svg',
                    'url'                  => 'sometimes|nullable',
                    'status'               => 'required',
                    'product_id'           => 'required',

                ];
            }
            default: break;
        }
    }
    
}

