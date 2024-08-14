<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ScheduleRequest extends FormRequest
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
    $currentYear = date('Y');
    return [
      "tanggal" => "required|integer|between:1,31",
      "bulan" => "required|integer|between:1,12",
      "tahun" => "required|integer|between:1900,$currentYear",
      "shift_id" => "required|uuid|exists:shift,id",
    ];
  }
  public function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response([
      "status" => "error",
      "message" => "Validation Error",
      "errors" => $validator->getMessageBag(),
    ], 422));
  }
}
