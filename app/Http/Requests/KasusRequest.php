<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'nama_kasus' => 'required|string|max:255',
            'nomor_kasus' => 'nullable|string|max:255',
            'kategori_perkara_id' => 'nullable|uuid',
            'jenis_perkara_id' => 'nullable|uuid',
            'lokasi_kasus' => 'nullable|string|max:255',
            'waktu_kejadian' => 'nullable|date_format:Y-m-d H:i:s',
            'tanggal_pelimpahan_kasus' => 'nullable|date_format:Y-m-d',
            'waktu_pelaporan_kasus' => 'nullable|date_format:Y-m-d H:i:s',
            'zona_waktu' => 'nullable|string|max:3',
            'tanggal_mulai_penyidikan' => 'nullable|date_format:Y-m-d H:i:s',
            'tanggal_mulai_sidang' => 'nullable|date_format:Y-m-d H:i:s',
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
            'nama_kasus.required' => 'Nama Kasus harus diisi',
            'nama_kasus.string' => 'Nama Kasus harus berupa string',
            'nomor_kasus.required' => 'Nomor Kasus harus diisi',
            'nomor_kasus.string' => 'Nomor Kasus harus berupa string',
            'kategori_perkara_id.string' => 'Kategori Perkara ID harus berupa string',
            'jenis_perkara_id.string' => 'Jenis Perkara ID harus berupa string',
            'lokasi_kasus.string' => 'Lokasi Kasus harus berupa string',
            'waktu_kejadian.datetime' => 'Waktu Kejadian harus berupa datetime',
            'tanggal_pelimpahan_kasus.date' => 'Tanggal Pelimpahan Kasus harus berupa date',
            'waktu_pelaporan_kasus.datetime' => 'Waktu Pelaporan Kasus harus berupa datetime',
            'zona_waktu.string' => 'Zona Waktu harus berupa string',
            'tanggal_mulai_penyidikan.datetime' => 'Tanggal Mulai Penyidikan harus berupa datetime',
            'tanggal_mulai_sidang.datetime' => 'Tanggal Mulai Sidang harus berupa datetime',
        ];
    }
}
