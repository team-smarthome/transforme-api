<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class KegiatanRequest extends FormRequest
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
            'nama_kegiatan' => 'required|string',
            'ruangan_otmil_id' => 'nullable|string',
            'ruangan_lemasmil_id' => 'nullable|string',
            'status_kegiatan' => 'nullable|string',
            'waktu_mulai_kegiatan' => 'required|date_format:Y-m-d H:i:s',
            'waktu_selesai_kegiatan' => 'required|date_format:Y-m-d H:i:s',
            'zona_waktu' => 'nullable|string',
            'peserta' => 'nullable|array',
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
            'nama_kegiatan.required' => 'Nama Kegiatan harus diisi',
            'nama_kegiatan.string' => 'Nama Kegiatan harus berupa string',
            'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
            'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
            'status_kegiatan.string' => 'Status Kegiatan harus berupa string',
            'waktu_mulai_kegiatan.datetime' => 'Waktu Mulai Kegiatan harus berupa datetime',
            'waktu_selesai_kegiatan.datetime' => 'Waktu Selesai Kegiatan harus berupa datetime',
            'zona_waktu.string' => 'Zona Waktu harus berupa string',
            'peserta.array' => 'Peserta harus berupa array',
        ];
    }

}
