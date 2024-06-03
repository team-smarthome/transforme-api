<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class HakimRequest extends FormRequest
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
            'nip' => 'required|string|max:18',
            'nama_hakim' => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'departemen' => 'nullable|string|max:100',
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
            'nip.required' => 'NIP harus diisi',
            'nip.max' => 'NIP maksimal 18 karakter',
            'nama_hakim.required' => 'Nama Hakim harus diisi',
            'nama_hakim.max' => 'Nama Hakim maksimal 100 karakter',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'departemen.max' => 'Departemen maksimal 100 karakter',
        ];
    }
}
