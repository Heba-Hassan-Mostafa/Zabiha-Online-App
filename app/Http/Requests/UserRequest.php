<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'first_name'    => 'required|string',
                        'last_name'     => 'required|string',
                        'email'         => 'required|email|max:255|unique:users',
                        'phone'         => 'required|numeric|unique:users',
                        'password'      => 'required|confirmed',
                        'image'         => 'nullable|image|max:20000,mimes:jpeg,jpg,png'

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'first_name'       => 'required',
                        'last_name'        => 'required',
                        'email'            => 'required|email|max:255',
                        'phone'            => 'required|numeric',
                        'password'         => 'nullable|min:8',
                        'image'            => 'nullable|image|max:20000,mimes:jpeg,jpg,png'

                    ];
                }
            default:
                break;
        }
    }
}
