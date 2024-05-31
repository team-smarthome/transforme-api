<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WbpProfileRequest extends FormRequest
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
            'nama' => 'required', 'string', 'max:100',
            'pangkat_id' => 'required', 'string', 'max:36',
            'kesatuan_id' => 'required', 'string', 'max:36',
            'tempat_lahir' => 'nullable', 'string', 'max:100',
            'tanggal_lahir' => 'nullable', 'date',
            'jenis_kelamin' => 'nullable',
            'provinsi_id' => 'required', 'string', 'max:36',
            'kota_id' => 'required', 'string', 'max:36',
            'alamat' => 'nullable','string',
            'agama_id' => 'required', 'string', 'max:36',
            'status_kawin_id' => 'required', 'string', 'max:36',
            'pendidikan_id' => 'required', 'string', 'max:36',
            'bidang_keahlian_id' => 'required', 'string', 'max:36',
            'foto_wajah' => 'nullable',
            'nomor_tahanan' => 'nullable',
            'residivis' => 'nullable',
            'status_wbp_kasus_id' => 'nullable',
            'foto_wajah_fr' => 'nullable',
            'is_isolated' => 'nullable',
            'is_sick' => 'nullable',
            'wbp_sickness' => 'nullable', 'string',
            'gelang_id' => 'nullable', 'string',
            'hunian_wbp_otmil_id' => 'nullable', 'string',
            'hunian_wbp_lemasmil_id' => 'nullable', 'string',
            'status_keluarga' => 'nullable', 'string',
            'nama_kontak_keluarga' => 'nullable', 'string',
            'hubungan_kontak_keluarga' => 'nullable', 'string',
            'nomor_kontak_keluarga' => 'nullable', 'string',
            'matra_id' => 'nullable', 'string',
            'nrp' => 'nullable', 'string',
            'tanggal_ditahan_otmil' => 'nullable', 'date',
            'tanggal_ditahan_lemasmil' => 'nullable', 'date',
            'tanggal_penetapan_tersangka' => 'nullable', 'date',
            'tanggal_penetapan_terdakwa' => 'nullable', 'date',
            'tanggal_penetapan_terpidana' => 'nullable', 'date',
            'kasus_id' => 'nullable', 'string',
            'is_diperbantukan' => 'nullable',
            'tanggal_masa_penahanan_otmil' => 'nullable', 'date'
        ];
    }
}
