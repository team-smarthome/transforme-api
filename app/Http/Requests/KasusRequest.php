<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KasusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'nama_kasus' => 'required|string',
            'nomor_kasus' => 'required|string',
            'wbp_profile_id' => 'nullable|string',
            'kategori_perkara_id' => 'nullable|string',
            'jenis_perkara_id' => 'nullable|string',
            'lokasi_kasus' => 'nullable|string',
            'waktu_kejadian' => 'datetime',
            'tanggal_pelimpahan_kasus' => 'date',
            'waktu_pelaporan_kasus' => 'datetime',
            'zona_waktu' => 'string',
            'tanggal_mulai_penyidikan' => 'datetime',
            'tanggal_mulai_sidang' => 'datetime',
        ];
    }
}
