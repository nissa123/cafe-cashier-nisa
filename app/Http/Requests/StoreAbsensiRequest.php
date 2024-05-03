<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsensiRequest extends FormRequest
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
            'nama_karyawan' => 'required',
            'tanggal_masuk' => 'required',
            'waktu_masuk' => 'required',
            'status' => 'required',
            'waktu_selesai_kerja' => 'required',
        ];
    }
    public function massages()
    {
        return[
            'nama_karyawan.required' => "Data Nama Karyawan belum diisi",
            'tanggal_masuk.required' => "Data Tanggal Masuk belum diisi",
            'waktu_masuk.required' => "Data Waktu Masuk belum diisi",
            'status.required' => "Data Status belum diisi",
            'waktu_selesai_kerja.required' => "Data Waktu Selesai Kerja belum diisi",
        ];
    }
}
