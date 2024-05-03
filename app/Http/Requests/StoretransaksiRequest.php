<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoretransaksiRequest extends FormRequest
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
            'tanggal' => '',
            'total_harga' => '',
            'metode_pembayaran' => '',
            'keterangan' => '',
            'orderedList' => '',
        ];
    }
    public function massages()
    {
        return[
            'tanggal.required' => "Data Tanggal belum diisi",
            'total.required' => "Data Total_harga Id belum diisi",
            'metode_pembayaran.required' => "Data Metode_pembayaran belum diisi",
            'keterangan.required' => "Data Keterangan belum diisi"
        ];
    }

}
