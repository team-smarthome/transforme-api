<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GateParkingRequest extends FormRequest
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
      'nama_gate_parking' => 'required|string',
      'gmac' => 'required|string',
      'ruangan_otmil_id' => 'nullable|string',
      'ruangan_lemasmil_id' => 'nullable|string',
      'status_gate_parking' => 'nullable|string',
      'v_gate_parking_topic' => 'nullable|string',
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
      'nama_gate_parking.required' => 'Nama gate_parking harus diisi',
      'nama_gate_parking.string' => 'Nama gate_parking harus berupa string ',
      'gmac.required' => 'Gmac harus di isi',
      'gmac.string' => 'Gmac harus berupa string',
      'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
      'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
      'status_gate_parking.string' => 'Status gate_parking harus berupa string',
      'v_gate_parking_topic.string' => 'V gate_parking Topic harus berupa string',
      'posisi_X.string' => 'Posisi X harus berupa string',
      'posisi_Y.string' => 'Posisi Y harus berupa string',
    ];
  }
}
