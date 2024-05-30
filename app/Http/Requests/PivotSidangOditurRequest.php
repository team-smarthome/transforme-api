<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class PivotSidangOditurRequest extends FormRequest
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
            'sidang_id' => 'required|uuid|exists:sidang,id',
            'role_ketua' => 'required|string',
            'oditur_penuntut_id' => 'required|uuid|exists:oditur_penuntut,id'
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
            'sidang_id.required' => 'Sidang ID harus diisi',
            'sidang_id.uuid' => 'Sidang ID harus berupa UUID',
            'sidang_id.exists' => 'Sidang ID tidak ditemukan',
            'role_ketua.required' => 'Role Ketua harus diisi',
            'role_ketua.string' => 'Role Ketua harus berupa string',
            'oditur_penuntut_id.required' => 'Oditur Penuntut ID harus diisi',
            'oditur_penuntut_id.uuid' => 'Oditur Penuntut ID harus berupa UUID',
            'oditur_penuntut_id.exists' => 'Oditur Penuntut ID tidak ditemukan'
        ];
    }
}
