<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationKiosRequest extends FormRequest
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
            'nama_registration_kios' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_registration_kios' => 'nullable|string',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable',
            'v_registration_kios_topic' => 'nullable|string'
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
            'nama_registration_kios.required' => 'Nama Registration Kios harus diisi',
            'nama_registration_kios.string' => 'Nama Registration Kios harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_registration_kios.string' => 'Status Registration Kios harus berupa string',
            'v_registration_kios_topic.string' => 'V Registration Kios Topic harus berupa string'
        ];
    }
    
}
