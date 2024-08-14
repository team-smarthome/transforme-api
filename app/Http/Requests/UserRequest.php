<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
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
      'username' => 'nullable|string|max:255',
      'password' => 'nullable|string|min:8',
      'email' => 'required|email|max:255',
      'phone' => 'required|string|max:15',
      'user_role_id' => 'required|uuid|exists:user_role,id',
      'lokasi_otmil_id' => 'nullable|uuid|exists:lokasi_otmil,id',
      'lokasi_lemasmil_id' => 'nullable|uuid|exists:lokasi_lemasmil,id',
      'is_suspended' => 'required|boolean',
      'petugas_id' => 'required|uuid|exists:petugas,id',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'last_login' => 'nullable|date',
      'expiry_date' => 'nullable|date|after_or_equal:today',
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
