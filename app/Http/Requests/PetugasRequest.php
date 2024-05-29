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
      'nama' => 'required|string|max:255',
      'pangkat_id' => 'required|uuid|exists:pangkat,id',
      'kesatuan_id' => 'required|uuid|exists:kesatuan,id',
      'tempat_lahir' => 'required|string|max:255',
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|max:1',
      'provinsi_id' => 'required|uuid|exists:provinsi,id',
      'kota_id' => 'required|uuid|exists:kota,id',
      'alamat' => 'required|string|max:255',
      'agama_id' => 'required|uuid|exists:agama,id',
      'status_kawin_id' => 'required|uuid|exists:status_kawin,id',
      'pendidikan_id' => 'required|uuid|exists:pendidikan,id',
      'bidang_keahlian_id' => 'required|uuid|exists:bidang_keahlian,id',
      'foto_wajah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'jabatan' => 'required|string|max:255',
      'divisi' => 'required|string|max:255',
      'nomor_petugas' => 'required|string|max:255',
      'lokasi_otmil_id' => 'required|uuid|exists:lokasi_otmil,id',
      'lokasi_lemasmil_id' => 'required|uuid|exists:lokasi_lemasmil,id',
      'grup_petugas_id' => 'required|uuid|exists:grup_petugas,id',
      'nrp' => 'required|string|max:255',
      'matra_id' => 'required|uuid|exists:matra,id',
      'foto_wajah_fr' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'lokasi_kesatuan_id' => 'required|uuid|exists:lokasi_kesatuan,id',
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
