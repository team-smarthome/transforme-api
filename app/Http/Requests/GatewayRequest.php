<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class GatewayRequest extends FormRequest
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
            'gmac' => 'required|string',
            'nama_gateway' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_gateway' => 'nullable|string',
            'v_gateway_topic' => 'nullable|string'
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response([
            "status" => "NO",
            "message" => "Validation Error",
            "errors" => $validator->getMessageBag()
        ], 422));
    }

    public function messages(): array {
        return [
            'gmac.required' => 'Gmac harus diisi',
            'gmac.string' => 'Gmac harus berupa string',
            'nama_gateway.required' => 'Nama Gateway harus diisi',
            'nama_gateway.string' => 'Nama Gateway harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_gateway.string' => 'Status Gateway harus berupa string',
            'v_gateway_topic.string' => 'V Gateway Topic harus berupa string'
        ];
    }
}
