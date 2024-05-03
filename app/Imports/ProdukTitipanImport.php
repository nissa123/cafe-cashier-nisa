<?php

namespace App\Imports;

use App\Models\ProdukTitipan;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukTitipanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ProdukTitipan([
            'nama_produk' => $row[1],
            'nama_supplier' => $row[2],
            'harga_beli' => $row[3],
            'harga_jual' => $row[4],
            'stok' => $row[5],
            'keterangan' => $row[6]
        ]);
    }
}
