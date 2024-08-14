<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RuanganLemasmilRequest extends FormRequest
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
            'nama_ruangan_lemasmil' => ['required', 'string'],
            'jenis_ruangan_lemasmil' => ['required', 'string'],
            'lokasi_lemasmil_id' => ['required', 'string'],
            'zona_id' => ['required', 'string'],
            'panjang' => ['required', 'numeric'],
            'lebar' => ['required', 'numeric'],
            'posisi_X' => ['required', 'numeric'],
            'posisi_Y' => ['required', 'numeric'],
            'lantai_lemasmil_id' => ['required', 'string']
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
            'nama_ruangan_lemasmil.required' => 'Nama Ruangan Lemasmil harus diisi',
            'nama_ruangan_lemasmil.string' => 'Nama Ruangan Lemasmil harus berupa string',
            'jenis_ruangan_lemasmil.required' => 'Jenis Ruangan Lemasmil harus diisi',
            'jenis_ruangan_lemasmil.string' => 'Jenis Ruangan Lemasmil harus berupa string',
            'lokasi_lemasmil_id.required' => 'Lokasi Lemasmil ID harus diisi',
            'zona_id.required' => 'Zona ID harus diisi',
            'panjang.required' => 'Panjang harus diisi',
            'panjang.numeric' => 'Panjang harus berupa angka',
            'lebar.required' => 'Lebar harus diisi',
            'lebar.numeric' => 'Lebar harus berupa angka',
            'posisi_X.required' => 'Posisi X harus diisi',
            'posisi_X.numeric' => 'Posisi X harus berupa angka',
            'posisi_Y.required' => 'Posisi Y harus diisi',
            'posisi_Y.numeric' => 'Posisi Y harus berupa angka',
            'lantai_lemasmil_id.required' => 'Lantai Lemasmil ID harus diisi'
        ];
    }
}
