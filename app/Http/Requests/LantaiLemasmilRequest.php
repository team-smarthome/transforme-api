<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class LantaiLemasmilRequest extends FormRequest
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
            'nama_lantai' => 'required|string|max:255',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'posisi_X' => 'required|numeric',
            'posisi_Y' => 'required|numeric',
            'lokasi_lemasmil_id' => 'required|uuid|exists:lokasi_lemasmil,id',
            'gedung_lemasmil_id' => 'required|uuid|exists:gedung_lemasmil,id',
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

    public function messages(): array {
        return [
            'nama_lantai.required' => 'Nama Lantai harus diisi',
            'nama_lantai.string' => 'Nama Lantai harus berupa string',
            'nama_lantai.max' => 'Nama Lantai maksimal 255 karakter',
            'panjang.required' => 'Panjang harus diisi',
            'panjang.numeric' => 'Panjang harus berupa angka',
            'lebar.required' => 'Lebar harus diisi',
            'lebar.numeric' => 'Lebar harus berupa angka',
            'posisi_X.required' => 'Posisi X harus diisi',
            'posisi_X.numeric' => 'Posisi X harus berupa angka',
            'posisi_Y.required' => 'Posisi Y harus diisi',
            'posisi_Y.numeric' => 'Posisi Y harus berupa angka',
            'lokasi_lemasmil_id.required' => 'Lokasi Lemasmil ID harus diisi',
            'lokasi_lemasmil_id.uuid' => 'Lokasi Lemasmil ID harus berupa UUID',
            'lokasi_lemasmil_id.exists' => 'Lokasi Lemasmil ID tidak ditemukan',
            'gedung_lemasmil_id.required' => 'Gedung Lemasmil ID harus diisi',
            'gedung_lemasmil_id.uuid' => 'Gedung Lemasmil ID harus berupa UUID',
            'gedung_lemasmil_id.exists' => 'Gedung Lemasmil ID tidak ditemukan',
        ];
    }
}
