<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BapRequest extends FormRequest
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
            'penyidikan_id' => 'required|string',
            'dokumen_bap_id' => 'required|string',
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
            'penyidikan_id.required' => 'Penyidikan ID harus diisi',
            'penyidikan_id.string' => 'Penyidikan ID harus berupa string',
            'dokumen_bap_id.required' => 'Dokumen BAP ID harus diisi',
            'dokumen_bap_id.string' => 'Dokumen BAP ID harus berupa string',
        ];
    }
}
