<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PenyidikanRequest extends FormRequest
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
            'nomor_penyidikan' => 'required|string|max:255',
            'kasus_id' => 'required|string|max:255',
            'waktu_dimulai_penyidikan' => 'required|date',
            'agenda_penyidikan' => 'required|string',
            'waktu_selesai_penyidikan' => 'required|date',
            'dokumen_bap_id' => 'nullable|string|max:255',
            'wbp_profile_id' => 'required|string|max:255',
            'saksi_id' => 'required|string|max:255',
            'oditur_penyidikan_id' => 'required|string|max:255',
            'zona_waktu' => 'required|string|max:255'
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
            'nomor_penyidikan.required' => 'Nomor Penyidikan harus diisi',
            'nomor_penyidikan.string' => 'Nomor Penyidikan harus berupa string',
            'nomor_penyidikan.max' => 'Nomor Penyidikan maksimal 255 karakter',
            'kasus_id.required' => 'Kasus ID harus diisi',
            'kasus_id.string' => 'Kasus ID harus berupa string',
            'kasus_id.max' => 'Kasus ID maksimal 255 karakter',
            'waktu_dimulai_penyidikan.required' => 'Waktu Dimulai Penyidikan harus diisi',
            'waktu_dimulai_penyidikan.date' => 'Waktu Dimulai Penyidikan harus berupa tanggal',
            'agenda_penyidikan.required' => 'Agenda Penyidikan harus diisi',
            'agenda_penyidikan.string' => 'Agenda Penyidikan harus berupa string',
            'waktu_selesai_penyidikan.required' => 'Waktu Selesai Penyidikan harus diisi',
            'waktu_selesai_penyidikan.date' => 'Waktu Selesai Penyidikan harus berupa tanggal',
            'dokumen_bap_id.string' => 'Dokumen BAP ID harus berupa string',
            'dokumen_bap_id.max' => 'Dokumen BAP ID maksimal 255 karakter',
            'wbp_profile_id.required' => 'WBP Profile ID harus diisi',
            'wbp_profile_id.string' => 'WBP Profile ID harus berupa string',
            'wbp_profile_id.max' => 'WBP Profile ID maksimal 255 karakter',
            'saksi_id.required' => 'Saksi ID harus diisi',
            'saksi_id.string' => 'Saksi ID harus berupa string',
            'saksi_id.max' => 'Saksi ID maksimal 255 karakter',
            'oditur_penyidikan_id.required' => 'Oditur Penyidikan ID harus diisi',
            'oditur_penyidikan_id.string' => 'Oditur Penyidikan ID harus berupa string',
            'oditur_penyidikan_id.max' => 'Oditur Penyidikan ID maksimal 255 karakter',
            'zona_waktu.required' => 'Zona Waktu harus diisi',
            'zona_waktu.string' => 'Zona Waktu harus berupa string',
            'zona_waktu.max' => 'Zona Waktu maksimal 255 karakter'
        ];
    }
}
