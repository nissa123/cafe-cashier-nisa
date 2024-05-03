<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorekaryawanRequest extends FormRequest
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
            'nip' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'telepon' => 'required',
            'agama' => 'required',
            'status_nikah' => 'required',
            'alamat' => 'required',
            'foto' => 'required',
        ];
    }
    public function massages(): array
    {
        return [
            'nip.required' => 'Data Nip belum di isi!',
            'nik.required' => 'Data Nik belum di isi!',
            'nama.required' => 'Data Nama belum di isi!',
            'jenis_kelamin.required' => 'Data Jenis kelamin belum di isi!',
            'tempat_lahir.required' => 'Data Tempat lahir belum di isi!',
            'tanggal_lahir.required' => 'Data Tanggal lahir belum di isi!',
            'telepon.required' => 'Data Telepon belum di isi!',
            'agama.required' => 'Data Agama belum di isi!',
            'status_nikah.required' => 'Data Status Nikah belum di isi!',
            'alamat.required' => 'Data Alamat belum di isi!',
            'foto.required' => 'Data Foto belum di isi!',

        ];
    }

}
