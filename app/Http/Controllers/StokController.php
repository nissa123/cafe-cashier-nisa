<?php

namespace App\Http\Controllers;

use App\Exports\StokExport;
use App\Models\stok;
use App\Http\Requests\StorestokRequest;
use App\Http\Requests\UpdatestokRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use App\Imports\StokImport;
use App\Models\menu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stok = stok::with('menu')->get();
        $menu = menu::all();

        return view('stok.index', compact('menu', 'stok'));
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
    public function store(StorestokRequest $request)
    {
        try{
            DB::beginTransaction();
            Stok::create($request->all());

            DB::commit();
            return redirect('stok')->with('success','Data berhasil ditambahkan!');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestokRequest $request, stok $stok)
    {
        $stok->update($request->all());
        return redirect('stok')->with('success','Update Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stok $stok)
    {
        $stok->delete();
       return redirect('/stok')->with('success','Data berhasil dihapus!');
    }

    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new StokExport, $date . '_Stok.xlsx');
    }

    public function importData(Request $request){

        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('DataStok', $namafile);
        Excel::import(new StokImport, \public_path('/DataStok/'.$namafile));
        return redirect()->back()->with('success', 'Import data berhasil');
    }
    
    
    public function stokpdf()
    {
        $stok = stok::all();
        $pdf = Pdf::loadView('stok.data', compact('stok'));
        return $pdf-> download('stok.pdf');
    }
}

