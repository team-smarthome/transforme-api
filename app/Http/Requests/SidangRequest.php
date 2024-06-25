<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class SidangRequest extends FormRequest
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
            'nama_sidang' => 'required|string',
            'jadwal_sidang' => 'nullable|date',
            'perubahan_jadwal_sidang' => 'nullable|date',
            'kasus_id' => 'nullable|uuid|exists:kasus,id',
            'tanggal_sidang' => 'nullable|date',
            'waktu_mulai_sidang' => 'nullable',
            'waktu_selesai_sidang' => 'nullable',
            'pengadilan_militer_id' => 'nullable|uuid|exists:pengadilan_militer,id',
            'agenda_sidang' => 'nullable|string',
            'hasil_keputusan_sidang' => 'nullable|string',
            'jenis_persidangan_id' => 'nullable|uuid|exists:jenis_persidangan,id',
            'juru_sita' => 'nullable|string',
            'juru_pengacara_sidang' => 'nullable|string',
            'pengawas_peradilan_militer' => 'nullable|string',
            'wbp_profile_id' => 'nullable',
            'zona_waktu' => 'nullable|string',
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
            'nama_sidang.required' => 'Nama Sidang harus diisi',
            'nama_sidang.string' => 'Nama Sidang harus berupa string',
            'jadwal_sidang.date' => 'Jadwal Sidang harus berupa tanggal',
            'perubahan_jadwal_sidang.date' => 'Perubahan Jadwal Sidang harus berupa tanggal',
            'kasus_id.uuid' => 'Kasus ID harus berupa UUID',
            'kasus_id.exists' => 'Kasus ID tidak ditemukan',
            'tanggal_sidang.date' => 'Tanggal Sidang harus berupa tanggal',
            'waktu_mulai_sidang.date_format' => 'Waktu Mulai Sidang harus berupa format H:i',
            'pengadilan_militer_id.uuid' => 'Pengadilan Militer ID harus berupa UUID',
            'pengadilan_militer_id.exists' => 'Pengadilan Militer ID tidak ditemukan',
            'agenda_sidang.string' => 'Agenda Sidang harus berupa string',
            'hasil_keputusan_sidang.string' => 'Hasil Keputusan Sidang harus berupa string',
            'jenis_persidangan_id.uuid' => 'Jenis Persidangan ID harus berupa UUID',
            'jenis_persidangan_id.exists' => 'Jenis Persidangan ID tidak ditemukan',
            'juru_sita.string' => 'Juru Sita harus berupa string',
            'juru_pengacara_sidang.string' => 'Juru Pengacara Sidang harus berupa string',
            'pengawas_peradilan_militer.string' => 'Pengawas Peradilan Militer harus berupa string',
            'wbp_profile_id.uuid' => 'WBP Profile ID harus berupa UUID',
            'wbp_profile_id.exists' => 'WBP Profile ID tidak ditemukan',
            'zona_waktu.string' => 'Zona Waktu harus berupa string',
            'oditur_penuntut_id.array' => 'Oditur Penuntut harus berupa array',
            'role_ketua.array' => 'Role Ketua harus berupa array',
            'nama_dokumen_persidangan.string' => 'Nama Dokumen harus diisi',
            'link_dokumen_persidangan.string' => 'Dokumen harus diisi',
        ];
    }
}
