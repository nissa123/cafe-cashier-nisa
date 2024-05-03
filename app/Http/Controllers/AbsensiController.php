<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Imports\AbsensiImport;
use App\Models\absensi;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\AbsensiController\generatepdf;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use PDOException;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['absensi'] = absensi::orderBy('created_at','ASC')->get();

        return view('absensi.index')->with($data);
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
    public function store(StoreAbsensiRequest $request)
    {
        try{
            DB::beginTransaction();
            Absensi::create($request->all());

            DB::commit();
            return redirect('absensi')->with('success','Data berhasil ditambahkan!');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        $absensi->update($request->all());
        return redirect('absensi')->with('success','Update Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
       return redirect('/absensi')->with('success','Data berhasil dihapus!');
    }
    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new AbsensiExport, $date . '_Absensi.xlsx');
    }
    public function importData(Request $request){

        $validator = FacadesValidator::make($request->all(), [
            'import' => 'required'
        ]);

        $request->validate([
            'file' => 'required'
        ]);


        $file = $request->file('file');
        // $validated = $validator->validated();

        Excel::import(new AbsensiImport, $file);

        return Redirect::back()->with('success', 'Data berhasil diimport');

    }
    public function pdfabsensi()
    {
        $absensi = absensi::all();
        $pdf = Pdf::loadView('absensi.data', compact('absensi'));
        return $pdf-> download('absensi.pdf');
    }
}
