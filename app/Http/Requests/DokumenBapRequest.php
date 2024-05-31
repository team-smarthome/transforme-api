<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class DokumenBapRequest extends FormRequest
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
            'penyidikan_id' => 'required|string',
            'nama_dokumen_bap' => 'required|string',
            'link_dokumen_bap' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'wbp_profile_id' => 'nullable|string',
            'saksi_id' => 'nullable|string'
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

    protected function messages(): array
    {
        return [
            'penyidikan_id.required' => 'Penyidikan harus diisi',
            'penyidikan_id.string' => 'Penyidikan harus berupa string',
            'nama_dokumen_bap.required' => 'Nama dokumen bap harus diisi',
            'nama_dokumen_bap.string' => 'Nama dokumen bap harus berupa string',
            'link_dokumen_bap.mimes' => 'Link dokumen bap harus berupa file pdf, doc, docx',
            'link_dokumen_bap.max' => 'Link dokumen bap maksimal 10240 karakter',
            'wbp_profile_id.string' => 'Wbp profile harus berupa string',
            'saksi_id.string' => 'Saksi harus berupa string'
        ];
    }
}
