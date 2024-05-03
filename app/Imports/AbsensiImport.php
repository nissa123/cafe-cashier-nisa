<?php

namespace App\Imports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\ToModel;

class AbsensiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Absensi([
            'nama_karyawan' => $row['1'],
            'tanggal_masuk' => $row['2'],
            'waktu_masuk' => $row['3'],
            'status' => $row['4'],
            'waktu_selesai_kerja' => $row['5']
        ]);
    }
    
}
