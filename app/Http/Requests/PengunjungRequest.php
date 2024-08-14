<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PengunjungRequest extends FormRequest
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
            'nama' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable',
            'provinsi_id' => 'nullable|uuid|exists:provinsi,id',
            'kota_id' => 'nullable|uuid|exists:kota,id',
            'alamat' => 'nullable|string',
            'foto_wajah' => 'nullable',
            'wbp_profile_id'  => 'nullable|string',
            'hubungan_wbp' => 'nullable|string',
            'nik' => 'nullable|string',
            'foto_wajah_fr' => 'nullable',
        ];
    }

    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response([
    //         "status" => "NO",
    //         "message" => "Validation Error",
    //         "errors" => $validator->getMessageBag()
    //     ], 422));
    // }

    public function messages(): array {
        return [
            'nama.nullable' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa string',
            'tempat_lahir.nullable' => 'Tempat Lahir harus diisi',
            'tempat_lahir.string' => 'Tempat Lahir harus berupa string',
            'tanggal_lahir.nullable' => 'Tanggal Lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal',
            'jenis_kelamin.nullable' => 'Jenis Kelamin harus diisi',
            'provinsi_id.nullable' => 'Provinsi ID harus diisi',
            'provinsi_id.uuid' => 'Provinsi ID harus berupa UUID',
            'provinsi_id.exists' => 'Provinsi ID tidak ditemukan',
            'kota_id.nullable' => 'Kota ID harus diisi',
            'kota_id.uuid' => 'Kota ID harus berupa UUID',
            'kota_id.exists' => 'Kota ID tidak ditemukan',
            'alamat.string' => 'Alamat harus berupa string',
            // 'foto_wajah.image' => 'Foto Wajah harus berupa gambar',
            'wbp_profile_id.nullable' => 'WBP Profile ID harus diisi',
            'wbp_profile_id.uuid' => 'WBP Profile ID harus berupa UUID',
            'wbp_profile_id.exists' => 'WBP Profile ID tidak ditemukan',
            'hubungan_wbp.string' => 'Hubungan WBP harus berupa string',
            'nik.string' => 'NIK harus berupa string',
            'foto_wajah_fr.image' => 'Foto Wajah FR harus berupa base64'
        ];
    }
}
