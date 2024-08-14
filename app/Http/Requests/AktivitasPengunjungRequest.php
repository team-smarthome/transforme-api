<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;



class AktivitasPengunjungRequest extends FormRequest
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
            'nama_aktivitas_pengunjung' => 'required|string',
            'waktu_mulai_kunjungan' => 'nullable|date',
            'waktu_selesai_kunjungan' => 'nullable|date',
            'tujuan_kunjungan' => 'nullable|string',
            'ruangan_otmil_id' => 'nullable|uuid|exists:ruangan_otmil,id',
            'ruangan_lemasmil_id' => 'nullable|uuid|exists:ruangan_lemasmil,id',
            'petugas_id' => 'nullable|uuid|exists:petugas,id',
            'pengunjung_id' => 'nullable|uuid|exists:pengunjung,id',
            'wbp_profile_id' => 'nullable|string',
            'zona_waktu' => 'nullable|string'
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
            'nama_aktivitas_pengunjung.required' => 'Nama Aktivitas Pengunjung harus diisi',
            'nama_aktivitas_pengunjung.string' => 'Nama Aktivitas Pengunjung harus berupa string',
            'waktu_mulai_kunjungan.date' => 'Waktu Mulai Kunjungan harus berupa tanggal',
            'waktu_selesai_kunjungan.date' => 'Waktu Selesai Kunjungan harus berupa tanggal',
            'tujuan_kunjungan.string' => 'Tujuan Kunjungan harus berupa string',
            'ruangan_otmil_id.uuid' => 'Ruangan OTMIL ID harus berupa UUID',
            'ruangan_otmil_id.exists' => 'Ruangan OTMIL ID tidak ditemukan',
            'ruangan_lemasmil_id.uuid' => 'Ruangan Lemasmil ID harus berupa UUID',
            'ruangan_lemasmil_id.exists' => 'Ruangan Lemasmil ID tidak ditemukan',
            'petugas_id.uuid' => 'Petugas ID harus berupa UUID',
            'petugas_id.exists' => 'Petugas ID tidak ditemukan',
            'pengunjung_id.uuid' => 'Pengunjung ID harus berupa UUID',
            'pengunjung_id.exists' => 'Pengunjung ID tidak ditemukan',
            'wbp_profile_id.string' => 'WBP Profile ID harus berupa string',
            'zona_waktu.string' => 'Zona Waktu harus berupa string'
        ];
    }
}
