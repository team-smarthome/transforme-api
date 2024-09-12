<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class XrayMechineRequest extends FormRequest
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
      'nama_xray_mechine' => 'required|string',
      'gmac' => 'required|string',
      'ruangan_otmil_id' => 'nullable|string',
      'ruangan_lemasmil_id' => 'nullable|string',
      'status_xray_mechine' => 'nullable|string',
      'v_xray_mechine_topic' => 'nullable|string',
      'posisi_X' => 'nullable',
      'posisi_Y' => 'nullable',
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

  public function messages(): array
  {
    return [
      'nama_xray_mechine.required' => 'Nama Xray mechine harus diisi',
      'nama_xray_mechine.string' => 'Nama Xray mechine harus berupa string ',
      'gmac.required' => 'Gmac harus di isi',
      'gmac.string' => 'Gmac harus berupa string',
      'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
      'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
      'status_xray_mechine.string' => 'Status Xray mechine harus berupa string',
      'v_xray_mechine_topic.string' => 'V Xray mechine Topic harus berupa string',
      'posisi_X.string' => 'Posisi X harus berupa string',
      'posisi_Y.string' => 'Posisi Y harus berupa string',
    ];
  }
}
