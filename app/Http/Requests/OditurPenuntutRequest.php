<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OditurPenuntutRequest extends FormRequest
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
            'nip' => 'required|string|max:255',
            'nama_oditur' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "status" => "NO",
            "message" => "Validation Error",
            "errors" => $validator->getMessageBag()
        ], 422));
    }

    public function messages(): array {
        return [
            'nip.required' => 'NIP harus diisi',
            'nip.string' => 'NIP harus berupa string',
            'nip.max' => 'NIP maksimal 255 karakter',
            'nama_oditur.required' => 'Nama Oditur harus diisi',
            'nama_oditur.string' => 'Nama Oditur harus berupa string',
            'nama_oditur.max' => 'Nama Oditur maksimal 255 karakter',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa string',
            'alamat.max' => 'Alamat maksimal 255 karakter',
        ];
    }
}
