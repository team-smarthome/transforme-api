<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class JenisPidanaRequest extends FormRequest
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
            "nama_jenis_pidana" => "required|string|max:255",
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response([
            "status" => "error",
            "message" => "Validation Error",
            "errors" => $validator->getMessageBag()
        ], 422));
    }
}