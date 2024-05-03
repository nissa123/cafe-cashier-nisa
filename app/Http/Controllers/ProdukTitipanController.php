<?php

namespace App\Http\Controllers;

use App\Exports\ProdukTitipanExport;
use App\Models\produktitipan;
use App\Http\Requests\StoreproduktitipanRequest;
use App\Http\Requests\UpdateproduktitipanRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;
use App\Imports\ProdukTitipanImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProdukTitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['produktitipan'] =  ProdukTitipan::orderBy('created_at','ASC')->get();

        return view('produktitipan.index')->with($data);
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
    public function store(StoreProdukTitipanRequest $request)
    {
        try{
            DB::beginTransaction();
            ProdukTitipan::create($request->all());
            DB::commit();
            return redirect('produktitipan')->with('success','Data berasil ditambahkan');
        }catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdukTitipan $produkTitipan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukTitipanRequest $request, ProdukTitipan $produktitipan)
    {
        $produktitipan->update($request->all());
        return redirect('produktitipan')->with('success',' Update Data berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdukTitipan $produktitipan)
    {
        $produktitipan->delete();
        return redirect('/produktitipan')->with('success','Data berhasil dihapus!');
    }
    public function exportData(){
        $date = date('Y-m-d');
        return Excel::download(new ProdukTitipanExport, $date. '_ProdukTitipan.xlsx');
    }
    public function importData(Request $request){

        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('DataProdukTitipan', $namafile);
        Excel::import(new ProdukTitipanImport, \public_path('/DataProdukTitipan/'.$namafile));
        return redirect()->back()->with('success', 'Import data berhasil');
    }
    
    
    public function produktitipanpdf()
    {
        $produktitipan = produktitipan::all();
        $pdf = Pdf::loadView('produktitipan.data', compact('produktitipan'));
        return $pdf-> download('produktitipan.pdf');
    }
}