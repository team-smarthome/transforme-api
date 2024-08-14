<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;



class LokasiOtmilRequest extends FormRequest
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
            "nama_lokasi_otmil" => 'required|string|max:255',
            "latitude" => 'required|numeric',
            "longitude" => 'required|numeric',
            "panjang" => 'required|numeric',
            "lebar" => 'required|numeric'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "status" => "error",
            "message" => "Validation Error",
            "errors" => $validator->getMessageBag()
        ], 422));
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'nama_lokasi_otmil.required' => 'Nama lokasi harus diisi',
            'nama_lokasi_otmil.string' => 'Nama lokasi harus berupa string',
            'nama_lokasi_otmil.max' => 'Nama lokasi maksimal 255 karakter',
            'latitude.required' => 'Latitude harus diisi',
            'latitude.numeric' => 'Latitude harus berupa angka',
            'longitude.required' => 'Longitude harus diisi',
            'longitude.numeric' => 'Longitude harus berupa angka',
            'panjang.required' => 'Panjang harus diisi',
            'panjang.numeric' => 'Panjang harus berupa angka',
            'lebar.required' => 'Lebar harus diisi',
            'lebar.numeric' => 'Lebar harus berupa angka'
        ];
    }
}
