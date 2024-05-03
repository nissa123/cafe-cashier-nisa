<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Models\pelanggan;
use App\Http\Requests\StorepelangganRequest;
use App\Http\Requests\UpdatepelangganRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\PelangganController\generatepdf;
use App\Http\Controllers\Pdf;
use App\Imports\PelangganImport;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use PDOException;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pelanggan'] = Pelanggan::orderBy('created_at','ASC')->get();

        return view('pelanggan.index')->with($data);
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
    public function store(StorepelangganRequest $request)
    {
        try{
            DB::beginTransaction();
            Pelanggan::create($request->all());

            DB::commit();
            return redirect('pelanggan')->with('success','Data berhasil ditambahkan!');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepelangganRequest $request, pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());
        return redirect('pelanggan')->with('success','Update Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pelanggan $pelanggan)
    {
        $pelanggan->delete();
       return redirect('/pelanggan')->with('success','Data berhasil dihapus!');
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new PelangganExport, $date. '_Pelanggan.xlsx');
    }

    public function importData(Request $request){

        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('DataPelanggan', $namafile);
        Excel::import(new PelangganImport, \public_path('/DataPelanggan/'.$namafile));
        return redirect()->back()->with('success', 'Import data berhasil');
    }
    

    public function generatepdf()
    {
        $pelanggan = pelanggan::all();
        $pdf = FacadePdf::loadView('pelanggan.data', compact('pelanggan'));
        return $pdf-> download('pelanggan.pdf');
    }
}
