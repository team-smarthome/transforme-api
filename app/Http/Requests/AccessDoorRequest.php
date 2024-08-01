<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AccessDoorRequest extends FormRequest
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
            'nama_access_door' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_access_door' => 'nullable|string',
            'v_access_door_topic' => 'nullable|string'
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
            'nama_access_door.required' => 'Nama Access Point harus diisi',
            'nama_access_door.string' => 'Nama Access Point harus berupa string',
            'model.string' => 'Model harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_access_door.string' => 'Status Access Point harus berupa string',
            'v_access_door_topic.string' => 'V Access Point Topic harus berupa string'
        ];
    }
}
