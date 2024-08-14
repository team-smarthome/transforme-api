<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
      'imei' => 'nullable|string|max:255',
      'wearer_name' => 'nullable|string|max:255',
      'health_data_periodic' => 'nullable',
      'status' => 'nullable',
      'is_used' => 'nullable',
      'device_type_id' => 'nullable',
      'device_model_id' => 'nullable',
      'manufacturer_id' => 'nullable',
      'firmware_version_id' => 'nullable',
      'platform_id' => 'nullable',

    ];
  }

  public function messages(): array
  {
    return [
      'imei.string' => 'IMEI harus berupa string',
      'imei.max' => 'IMEI maksimal 255 karakter',
      'wearer_name.string' => 'Wearer Name harus berupa string',
      'wearer_name.max' => 'Wearer Name maksimal 255 karakter',
    ];
  }
}
