<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AutogateSingleRequest extends FormRequest
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
      'nama_autogate_single' => 'required|string',
      'gmac' => 'required|string',
      'ruangan_otmil_id' => 'nullable|string',
      'ruangan_lemasmil_id' => 'nullable|string',
      'status_autogate_single' => 'nullable|string',
      'v_autogate_single_topic' => 'nullable|string'
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
      'nama_autogate_single.required' => 'Nama Autogate single harus diisi',
      'nama_autogate_single.string' => 'Nama Autogate single harus berupa string ',
      'gmac.required' => 'Gmac harus di isi',
      'gmac.string' => 'Gmac harus berupa string',
      'ruangan_otmil_id.string' => 'Ruangan OTMIL ID harus berupa string',
      'ruangan_lemasmil_id.string' => 'Ruangan Lemasmil ID harus berupa string',
      'status_autogate_single.string' => 'Status Autogate single harus berupa string',
      'v_autogate_single_topic.string' => 'V Autogate single Topic harus berupa string'
    ];
  }
}
