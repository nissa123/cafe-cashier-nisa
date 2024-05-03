<?php

namespace App\Http\Controllers;

use App\Exports\MejaExport;
use App\Models\meja;
use App\Http\Requests\StoremejaRequest;
use App\Http\Requests\UpdatemejaRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use App\Imports\MejaImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['meja'] = Meja::orderBy('created_at','ASC')->get();

        return view('meja.index')->with($data);
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
    public function store(StoremejaRequest $request)
    {
        try{
            DB::beginTransaction();
            Meja::create($request->all());

            DB::commit();
            return redirect('meja')->with('success','Data berhasil ditambahkan!');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(meja $meja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemejaRequest $request, meja $meja)
    {
        $meja->update($request->all());
        return redirect('meja')->with('success','Update Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(meja $meja)
    {
        $meja->delete();
       return redirect('/meja')->with('success','Data berhasil dihapus!');
    }
    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new MejaExport, $date. '_Meja.xlsx');
    }

    public function importData(Request $request){

        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('DataMeja', $namafile);
        Excel::import(new MejaImport, \public_path('/DataMeja/'.$namafile));
        return redirect()->back()->with('success', 'Import data berhasil');
    }
    
    
    public function mejapdf()
    {
        $meja = meja::all();
        $pdf = Pdf::loadView('meja.data', compact('meja'));
        return $pdf-> download('meja.pdf');
    }

}
