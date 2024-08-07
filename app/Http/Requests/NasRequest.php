<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NasRequest extends FormRequest
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
            'nama_nas' => 'required|string',
            'gmac' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_nas' => 'nullable|string',
            'v_nas_topic' => 'nullable|string'
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
            'nama_nas.required' => 'Nama Nas harus diisi',
            'nama_nas.string' => 'Nama Nas harus berupa string',
            'gmac.required' => 'Gmac harus di isi',
            'gmac.string' => 'Gmac harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_nas.string' => 'Status Nas harus berupa string',
            'v_nas_topic.string' => 'V Nas Topic harus berupa string'
        ];
    }
}
