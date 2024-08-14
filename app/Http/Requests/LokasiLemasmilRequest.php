<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class LokasiLemasmilRequest extends FormRequest
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
            'nama_lokasi_lemasmil' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
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

    public function messages(): array
    {
        return [
            'nama_lokasi_lemasmil.required' => 'Nama lokasi Lemasmil harus diisi',
            'nama_lokasi_lemasmil.string' => 'Nama lokasi Lemasmil harus berupa string',
            'nama_lokasi_lemasmil.max' => 'Nama lokasi Lemasmil maksimal 255 karakter',
            'latitude.required' => 'Latitude harus diisi',
            'latitude.string' => 'Latitude harus berupa string',
            'longitude.required' => 'Longitude harus diisi',
            'longitude.string' => 'Longitude harus berupa string',
            'panjang.required' => 'Panjang harus diisi',
            'panjang.numeric' => 'Panjang harus berupa angka',
            'lebar.required' => 'Lebar harus diisi',
            'lebar.numeric' => 'Lebar harus berupa angka'
        ];
    }

}
