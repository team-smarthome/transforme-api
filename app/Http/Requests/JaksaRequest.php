<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class JaksaRequest extends FormRequest
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
            'nrp_jaksa' => 'required|string|max:100',
            'nama_jaksa' => 'required|string|max:100',
            'alamat' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'spesialisasi_hukum' => 'required|string|max:100',
            'divisi' => 'required|string|max:100',
            'tanggal_pensiun' => 'required|string|max:100'
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response([
            'status' => 'error',
            'message' => 'Validation Error',
            'errors' => $validator->getMessageBag()
        ], 422));
    }
}
