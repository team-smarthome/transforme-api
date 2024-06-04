<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class GatewayLogRequest extends FormRequest
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
            'wbp_profile_id' => 'nullable|exists:wbp_profile,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'gateway_id' => 'required|exists:gateway,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "status" => "error",
            "message" => "Validation Error",
            "errors" => $validator->getMessageBag()
        ], 422));
    }

    public function messages(): array
    {
        return [
            'wbp_profile_id.exists' => 'Wbp Profile tidak ditemukan',
            'image.required' => 'Image harus diisi',
            'image.image' => 'Image harus berupa file gambar',
            'image.mimes' => 'Image harus berupa file jpeg, png, jpg, gif',
            'image.max' => 'Image maksimal 10240 KB',
            'gateway_id.required' => 'Gateway harus diisi',
            'gateway_id.exists' => 'Gateway tidak ditemukan'
        ];
    }

}
