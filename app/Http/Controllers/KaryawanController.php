<?php

namespace App\Http\Controllers;

use App\Exports\KaryawanExport;
use App\Models\karyawan;
use App\Http\Requests\StorekaryawanRequest;
use App\Http\Requests\UpdatekaryawanRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use App\Imports\karayawanImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['karyawan'] = Karyawan::orderBy('created_at','ASC')->get();
        return view('karyawan.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekaryawanRequest $request)
    {
        try{
            DB::beginTransaction();
            Karyawan::create($request->all());

            DB::commit();
            return redirect('karyawan')->with('success','Data berhasil ditambahkan!');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekaryawanRequest $request, karyawan $karyawan)
    {
        $karyawan->update($request->all());
        return redirect('karyawan')->with('success','Update Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(karyawan $karyawan)
    {
        $karyawan->delete();
       return redirect('/karyawan')->with('success','Data berhasil dihapus!');
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new KaryawanExport, $date. '_Karyawan.xlsx');
    }
    public function importData(Request $request){

        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('DataKaryawan', $namafile);
        // Excel::import(new JenisImport, \public_path('/DataJenis/'.$namafile));
        return redirect()->back()->with('success', 'Import data berhasil');
    }

    public function karyawanpdf()
    {
        $karyawan = karyawan::all();
        $pdf = Pdf::loadView('karyawan.data', compact('karyawan'));
        return $pdf-> download('karyawan.pdf');
    }
}


