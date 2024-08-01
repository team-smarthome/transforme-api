<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DesktopRequest extends FormRequest
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
            'model' => 'required|string',
            'nama_desktop' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_desktop' => 'nullable|string',
            'v_desktop_topic' => 'nullable|string'
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
            'nama_desktop.required' => 'Nama Desktop harus diisi',
            'nama_desktop.string' => 'Nama Desktop harus berupa string',
            'model.string' => 'Model harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_desktop.string' => 'Status Desktop harus berupa string',
            'v_desktop_topic.string' => 'V Desktop Topic harus berupa string'
        ];
    }
}
