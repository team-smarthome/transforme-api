<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelfRegRequest extends FormRequest
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
            'nama_m_kiosk' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_m_kiosk' => 'nullable|string',
            'v_m_kiosk_topic' => 'nullable|string'
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
            'nama_m_kiosk.required' => 'Nama M Kiosk harus diisi',
            'nama_m_kiosk.string' => 'Nama M Kiosk harus berupa string',
            'model.string' => 'Model harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_m_kiosk.string' => 'Status M Kiosk harus berupa string',
            'v_m_kiosk_topic.string' => 'V M Kiosk Topic harus berupa string'
        ];
    }
}
