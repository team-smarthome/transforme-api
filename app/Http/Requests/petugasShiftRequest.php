<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class petugasShiftRequest extends FormRequest
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
      "shift_id" => "required|uuid|exists:shift,id",
      "petugas_id" => "required|uuid|exists:petugas,id",
      "schedule_id" => "required|uuid|exists:schedule,id",
      "status_kehadiran" => "nullable|integer|in:0,1",
      "jam_kehadiran" => "nullable|date",
      "status_izin" => "nullable|string|max:100",
      "penugasan_id" => "required|uuid|exists:penugasan,id",
      "lokasi_otmil_id" => "nullable|uuid|exists:lokasi_otmil,id",
      "lokasi_lemasmil_id" => "nullable|uuid|exists:lokasi_lemasmil,id",
      "status_pengganti" => "nullable|string|max:36",
      "lembur" => "nullable|integer|in:0,1",
      "keterangan_lembur" => "nullable|string|max:100"
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
