<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorekategoriRequest extends FormRequest
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
            'nama' => 'required',
        ];
    }
    public function massages()
    {
        return[
            'nama.required' => "Data Nama belum diisi",
        ];
    }
}
