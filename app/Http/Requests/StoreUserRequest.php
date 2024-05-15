<?php

namespace App\Http\Requests;

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreUserRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'employee_id' => ['required', 'unique:users,employee_id'],
      'nip' => ['required', 'exists:employees,nip'],
      'password' => ['required', 'min:6'],
      'roles' => ['required', 'array'],
      'roles.*' => ['required', 'exists:roles,id']
    ];
  }

  public function prepareForValidation(): void
  {
    $this->merge([
      'password' => Hash::make(UserController::$DEFAULT_PASSWORD)
    ]);
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'employee_id.unique' => "Data pegawai sudah digunakan oleh user lain",
      'nip.exists' => "NIP {$this->nip} tidak valid",
    ];
  }
}
