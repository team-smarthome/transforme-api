<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WbpPerkaraRequest extends FormRequest
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
            'kategori_perkara_id' => 'required|string|max:36',
            'jenis_perkara_id' => 'required|string|max:36',
            'vonis_tahun' => 'nullable',
            'vonis_bulan' => 'nullable',
            'vonis_hari' => 'nullable',
            'tanggal_ditahan_otmil' => 'required|date',
            'tanggal_ditahan_lemasmil' => 'nullable|date',
            'lokasi_otmil_id' => 'required|string|max:36',
            'lokasi_lemasmil_id' => 'nullable|string|max:36',
            'residivis' => 'nullable',
            'wbp_profile_id' => 'required|string|max:36',
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
            'kategori_perkara_id.uuid' => 'Kategori Perkara harus diisi',
            'jenis_perkara_id.uuid' => 'Jenis Perkara harus diisi',
            'vonis_tahun' => 'Voni Tahun',
            'vonis_bulan' => 'Voni Bulan',
            'vonis_hari' => 'Voni Hari',
            'tanggal_ditahan_otmil.date' => 'Format harus berupa tanggal',
            'tanggal_ditahan_lemasmil.nullable' => 'Format harus berupa tanggal',
            'lokasi_otmil_id.uuid' => 'Lokasi Otmil harus diisi',
            'lokasi_lemasmil_id.nullable' => 'Lokasi Lemasmil',
            'residivis' => 'Residivis',
            'wbp_profile_id.uuid' => 'Wbp Profile harus diisi',
        ];
    }
}
