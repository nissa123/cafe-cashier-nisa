<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukTitipanRequest extends FormRequest
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
            'nama_produk' => 'required',
            'nama_supplier' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
        ];
    }
    public function massages()
    {
        return[
            'nama_produk.required' => "Data Nama Produk belum diisi",
            'nama_supplier.required' => "Data Nama Supplier belum diisi",
            'harga_beli.required' => "Data Harga Beli belum diisi",
            'harga_jual.required' => "Data Harga Jual belum diisi",
            'stok.required' => "Data Nama Stok belum diisi",
            'keterangan.required' => "Data Keterangan belum diisi"
        ];
    }
}
