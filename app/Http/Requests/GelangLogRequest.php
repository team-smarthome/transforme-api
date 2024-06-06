<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GelangLogRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize()
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
      'gelang_id' => 'nullable|string',
      'v_gmac' => 'nullable|string',
      'v_dmac' => 'nullable|string',
      'v_vbatt' => 'nullable|string',
      'v_step' => 'nullable|string',
      'v_heartrate' => 'nullable|string',
      'v_temp' => 'nullable|string',
      'v_spo' => 'nullable|string',
      'v_systolic' => 'nullable|string',
      'v_diastolic' => 'nullable|string',
      'v_rssi' => 'nullable|string',
      'n_cutoff_flag' => 'nullable|integer',
      'n_type' => 'nullable|integer',
      'v_x0' => 'nullable|string',
      'v_y0' => 'nullable|string',
      'v_z0' => 'nullable|string',
      'd_time' => 'date',
      'n_isavailable' => 'required|integer',
      'v_gateway_topic' => 'nullable|string',
    ];
  }
}
