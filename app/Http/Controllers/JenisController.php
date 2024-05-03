<?php

namespace App\Http\Controllers;

use App\Exports\JenisExport;
use App\Models\jenis;
use App\Http\Requests\StorejenisRequest;
use App\Http\Requests\UpdatejenisRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use App\Imports\JenisImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis'] = Jenis::orderBy('created_at','ASC')->get();

        return view('jenis.index')->with($data);
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
    public function store(StoreJenisRequest $request)
    {
        try{
            DB::beginTransaction();
            jenis::create($request->all());

            DB::commit();
            return redirect('jenis')->with('success','Data berhasil ditambahkan!');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisRequest $request, Jenis $jeni)
    {
        $jeni->update($request->all());
        return redirect('jenis')->with('success','Update Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jeni)
    {
       $jeni->delete();
       return redirect('/jenis')->with('success','Data berhasil dihapus!');
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new JenisExport, $date. '_Jenis.xlsx');
    }
    public function importData(Request $request){

        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('DataJenis', $namafile);
        Excel::import(new JenisImport, \public_path('/DataJenis/'.$namafile));
        return redirect()->back()->with('success', 'Import data berhasil');
    }

    public function jenispdf()
    {
        $jenis = jenis::all();
        $pdf = Pdf::loadView('jenis.data', compact('jenis'));
        return $pdf-> download('jenis.pdf');
    }
}


