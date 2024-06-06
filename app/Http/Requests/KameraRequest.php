<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KameraRequest extends FormRequest
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
      "nama_kamera" => "nullable|string|max:100",
      "url_rtsp" => "nullable|string|max:100",
      "ip_address" => "nullable|string|max:100",
      "ruangan_otmil_id" => "nullable|uuid|exists:ruangan_otmil,id",
      "ruangan_lemasmil_id" => "nullable|uuid|exists:ruangan_lemasmil,id",
      "merk" => "nullable|string|max:100",
      "model" => "nullable|string|max:100",
      "status_kamera" => "nullable|string|max:100"
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
}
