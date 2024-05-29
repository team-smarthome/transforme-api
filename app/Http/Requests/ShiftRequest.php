<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShiftRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            'nama_shift.required' => 'Nama shift harus diisi',
            'nama_shift.string' => 'Nama shift harus berupa string',
            'nama_shift.max' => 'Nama shift maksimal 255 karakter',
            'waktu_mulai.required' => 'Waktu mulai harus diisi',
            'waktu_mulai.date_format' => 'Waktu mulai harus berupa format H:i',
            'waktu_selesai.required' => 'Waktu selesai harus diisi',
            'waktu_selesai.date_format' => 'Waktu selesai harus berupa format H:i'
        ];
    }
}
