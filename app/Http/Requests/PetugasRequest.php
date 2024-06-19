<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PetugasRequest extends FormRequest
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
      'nama' => 'nullable|string|max:255',
      'pangkat_id' => 'nullable|uuid|exists:pangkat,id',
      'kesatuan_id' => 'nullable|uuid|exists:kesatuan,id',
      'tempat_lahir' => 'nullable|string|max:255',
      'tanggal_lahir' => 'nullable|date',
      'jenis_kelamin' => 'nullable|integer|max:1',
      'provinsi_id' => 'nullable|uuid|exists:provinsi,id',
      'kota_id' => 'nullable|uuid|exists:kota,id',
      'alamat' => 'nullable|string|max:255',
      'agama_id' => 'nullable|uuid|exists:agama,id',
      'status_kawin_id' => 'nullable|uuid|exists:status_kawin,id',
      'pendidikan_id' => 'nullable|uuid|exists:pendidikan,id',
      'bidang_keahlian_id' => 'nullable|uuid|exists:bidang_keahlian,id',
      'foto_wajah' => 'nullable',
      'jabatan' => 'nullable|string|max:255',
      'divisi' => 'nullable|string|max:255',
      'nomor_petugas' => 'nullable|string|max:255',
      'lokasi_otmil_id' => 'nullable|uuid|exists:lokasi_otmil,id',
      'lokasi_lemasmil_id' => 'nullable|uuid|exists:lokasi_lemasmil,id',
      'grup_petugas_id' => 'nullable|uuid|exists:grup_petugas,id',
      'nrp' => 'nullable|string|max:255',
      'matra_id' => 'nullable|uuid|exists:matra,id',
      'foto_wajah_fr' => 'nullable',
      'lokasi_kesatuan_id' => 'nullable|uuid|exists:lokasi_kesatuan,id',
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
}
