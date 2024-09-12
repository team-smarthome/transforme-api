<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmergencyPushRequest extends FormRequest
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
            'nama_emergency_push_button' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_emergency_push_button' => 'nullable|string',
            'posisi_X' => 'nullable',
            'posisi_Y' => 'nullable',
            'v_emergency_push_button_topic' => 'nullable|string'
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

    public function messages(): array
    {
        return [
            'gmac.required' => 'Gmac harus diisi',
            'gmac.string' => 'Gmac harus berupa string',
            'nama_emergency_push_button.required' => 'Nama Emergency Push Button harus diisi',
            'nama_emergency_push_button.string' => 'Nama Emergency Push Button harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_emergency_push_button.string' => 'Status Emergency Push Button harus berupa string',
            'v_emergency_push_button_topic.string' => 'V Emergency Push Button Topic harus berupa string'
        ];
    }
}
