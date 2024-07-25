<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MstManufacturerRequest extends FormRequest
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
            'manufacture' => 'required|string|max:255',
            'platform_id' => 'required|uuid|string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "status" => "NO",
            "message" => "Validation Error",
            "errors" => $validator->getMessageBag()
        ], 422));
    }

    public function messages(): array {
        return [
            'manufacture.required' => 'Manufacture harus diisi',
            'manufacture.string' => 'Manufacture harus berupa string',
            'platform_id.uuid' => 'Platform ID harus berupa UUID',
            'platform_id.required' => 'Platform ID harus diisi',
            'platform_id.string' => 'Platform ID harus berupa string',
        ];
    }
}
