<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PengadilanMiliterRequest extends FormRequest
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
            'nama_pengadilan_militer' => 'required|string|max:255',
            'provinsi_id' => 'required|string|max:255',
            'kota_id' => 'nullable|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
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
            'nama_pengadilan_militer.required' => 'Nama Pengadilan Militer harus diisi',
            'nama_pengadilan_militer.string' => 'Nama Pengadilan Militer harus berupa string',
            'nama_pengadilan_militer.max' => 'Nama Pengadilan Militer maksimal 255 karakter',
            'provinsi_id.required' => 'Provinsi harus diisi',
            'provinsi_id.string' => 'Provinsi harus berupa string',
            'provinsi_id.max' => 'Provinsi maksimal 255 karakter',
            'kota_id.required' => 'Kota harus diisi',
            'kota_id.string' => 'Kota harus berupa string',
            'kota_id.max' => 'Kota maksimal 255 karakter',
            'latitude.required' => 'Latitude harus diisi',
            'latitude.string' => 'Latitude harus berupa string',
            'latitude.max' => 'Latitude maksimal 255 karakter',
            'longitude.required' => 'Longitude harus diisi',
            'longitude.string' => 'Longitude harus berupa string',
            'longitude.max' => 'Longitude maksimal 255 karakter',
        ];
    }
}
