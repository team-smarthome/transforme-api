<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AsetRequest extends FormRequest
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
            'nama_aset' => 'nullable|string|max:255',
            'tipe_aset_id' => 'nullable|uuid|exists:tipe_aset,id',
            'ruangan_otmil_id' => 'nullable|uuid|exists:ruangan_otmil,id',
            'ruangan_lemasmil_id' => 'nullable|uuid|exists:ruangan_lemasmil,id',
            'kondisi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'serial_number' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'image' => 'nullable',
            'merek' => 'nullable|string|max:255',
            'garansi' => 'nullable|string|max:255'
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
            'nama_aset.required' => 'Nama Aset harus diisi',
            'nama_aset.string' => 'Nama Aset harus berupa string',
            'nama_aset.max' => 'Nama Aset maksimal 255 karakter',
            'tipe_aset_id.uuid' => 'Tipe Aset ID harus berupa UUID',
            'tipe_aset_id.exists' => 'Tipe Aset ID tidak ditemukan',
            'ruangan_otmil_id.uuid' => 'Ruangan Otmil ID harus berupa UUID',
            'ruangan_otmil_id.exists' => 'Ruangan Otmil ID tidak ditemukan',
            'ruangan_lemasmil_id.uuid' => 'Ruangan Lemasmil ID harus berupa UUID',
            'ruangan_lemasmil_id.exists' => 'Ruangan Lemasmil ID tidak ditemukan',
            'kondisi.string' => 'Kondisi harus berupa string',
            'kondisi.max' => 'Kondisi maksimal 255 karakter',
            'keterangan.string' => 'Keterangan harus berupa string',
            'keterangan.max' => 'Keterangan maksimal 255 karakter',
            'tanggal_masuk.date' => 'Tanggal Masuk harus berupa tanggal',
            'serial_number.string' => 'Serial Number harus berupa string',
            'serial_number.max' => 'Serial Number maksimal 255 karakter',
            'model.string' => 'Model harus berupa string',
            'model.max' => 'Model maksimal 255 karakter',
            'image.mimes' => 'Gambar harus berupa file jpeg, png, jpg, gif',
            'image.max' => 'Gambar maksimal 10MB',
            'merek.string' => 'Merek harus berupa string',
            'merek.max' => 'Merek maksimal 255 karakter',
            'garansi.string' => 'Garansi harus berupa string',
            'garansi.max' => 'Garansi maksimal 255 karakter'
        ];
    }

}
