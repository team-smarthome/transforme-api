<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class BarangBuktiKasusRequest extends FormRequest
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
          'kasus_id'  => 'required|exists:kasus,id',
          'nama_bukti_kasus' => 'required|string|max:255', 
          'nomor_barang_bukti' => 'required|string|max:255',
          'dokumen_barang_bukti' => 'nullable|mimes:pdf,doc,docx|max:10240',
          'gambar_barang_bukti' => 'nullable',
          'keterangan' => 'nullable|string',
          'tanggal_diambil' => 'required|date',
          'longitude' => 'nullable|string|max:255',
          'jenis_perkara_id' => 'required|exists:jenis_perkara,id'
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
            'kasus_id.required' => 'Kasus harus diisi',
            'kasus_id.exists' => 'Kasus tidak ditemukan',
            'nama_bukti_kasus.required' => 'Nama bukti kasus harus diisi',
            'nama_bukti_kasus.string' => 'Nama bukti kasus harus berupa string',
            'nama_bukti_kasus.max' => 'Nama bukti kasus maksimal 255 karakter',
            'nomor_barang_bukti.required' => 'Nomor barang bukti harus diisi',
            'nomor_barang_bukti.string' => 'Nomor barang bukti harus berupa string',
            'nomor_barang_bukti.max' => 'Nomor barang bukti maksimal 255 karakter',
            'dokumen_barang_bukti.mimes' => 'Dokumen barang bukti harus berupa file pdf, doc, docx',
            'dokumen_barang_bukti.max' => 'Dokumen barang bukti maksimal 10MB',
            'gambar_barang_bukti.image' => 'Gambar barang bukti harus berupa file gambar',
            'gambar_barang_bukti.mimes' => 'Gambar barang bukti harus berupa file jpeg, png, jpg, gif',
            'gambar_barang_bukti.max' => 'Gambar barang bukti maksimal 10MB',
            'keterangan.string' => 'Keterangan harus berupa string',
            'tanggal_diambil.required' => 'Tanggal diambil harus diisi',
            'tanggal_diambil.date' => 'Tanggal diambil harus berupa tanggal',
            'longitude.required' => 'Longitude harus diisi',
            'longitude.string' => 'Longitude harus berupa string',
            'longitude.max' => 'Longitude maksimal 255 karakter',
            'jenis_perkara_id.required' => 'Jenis perkara harus diisi',
            'jenis_perkara_id.exists' => 'Jenis perkara tidak ditemukan'
        ];
    }
}
