<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaceRecRequest extends FormRequest
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
            'nama_face_rec' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_face_rec' => 'nullable|string',
            'v_face_rec_topic' => 'nullable|string'
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
            'nama_face_rec.required' => 'Nama Face Rec harus diisi',
            'nama_face_rec.string' => 'Nama Face Rec harus berupa string',
            'model.string' => 'Model harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_face_rec.string' => 'Status Face Rec harus berupa string',
            'v_face_rec_topic.string' => 'V Face Rec Topic harus berupa string'
        ];
    }
}
