<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
      'nip' => ['required', 'exists:employees,nip'],
      'roles' => ['array'],
      'roles.*' => ['required', 'exists:roles,id']
    ];
  }

  // public function prepareForValidation(): void
  // {
  //   $this->merge([
  //     'slug' => str(strtolower($this->name))->slug()->value(),
  //     'password' => Hash::make(UserController::$DEFAULT_PASSWORD)
  //   ]);
  // }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'nip.exists' => "NIP {$this->nip} tidak valid",
    ];
  }
}
