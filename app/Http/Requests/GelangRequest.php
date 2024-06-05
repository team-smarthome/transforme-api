<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GelangRequest extends FormRequest
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
      'dmac' => 'required|string|max:100',
      'nama_gelang' => 'required|string|max:100',
      'tanggal_pasang' => 'required|date',
      'tanggal_aktivasi' => 'required|date',
      'ruangan_otmil_id' => 'nullable|uuid|exists:ruangan_otmil,id',
      'ruangan_lemasmil_id' => 'nullable|uuid|exists:ruangan_lemasmil,id',
      'baterai' => 'required|string|max:100'
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
