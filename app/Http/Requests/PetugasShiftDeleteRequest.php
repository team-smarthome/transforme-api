<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PetugasShiftDeleteRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): array
  {
    return [
      'petugas_shift_id' => 'required|array',
      'petugas_shift_id.*' => 'uuid|exists:petugas_shift,id',
    ];
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'nama_shift' => 'required|string|max:255',
      'waktu_mulai' => 'required|date_format:H:i',
      'waktu_selesai' => 'required|date_format:H:i'
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
