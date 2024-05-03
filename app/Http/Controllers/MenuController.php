<?php

namespace App\Http\Controllers;

use App\Exports\MenuExport;
use App\Imports\MenuImport;
use App\Models\menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Jenis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDOException;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::with('jenis')->get();
        $jenis = Jenis::all();

        return view('menu.index', compact('jenis', 'menu'));
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
    public function store(StoremenuRequest $request)
    {
        try {
            DB::beginTransaction();

            $menu = Menu::create($request->all());

            // Mendapatkan file yang diunggah oleh pengguna
            $file = $request->file('image');

            // Menyimpan file gambar ke direktori penyimpanan 'menu' dengan nama yang unik
            $file_name = $file->getClientOriginalName(); // Nama file asli
            $file_path = $file->storeAs('menu', $file_name); // Simpan file dengan nama unik di direktori 'menu'

            // Simpan nama file ke dalam kolom image di database
            $menu->image = $file_path;
            $menu->save();
            // Menu::create($request->all());
            DB::commit();
            return redirect('menu')->with('success', 'Data berhasil ditambahkan!');
        } catch (QueryException | Exception | PDOException) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemenuRequest $request, menu $menu)
    {
        $menu->update($request->all());
        return redirect('menu')->with('success', 'Update Data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menu $menu)
    {
        $menu->delete();
        return redirect('/menu')->with('success', 'Data berhasil dihapus!');
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new MenuExport, $date . '_Menu.xlsx');
    }

    public function importData(Request $request)
    {

        $validator = FacadesValidator::make($request->all(), [
            'import' => 'required'
        ]);

        $request->validate([
            'file' => 'required'
        ]);


        $file = $request->file('file');
        // $validated = $validator->validated();

        Excel::import(new MenuImport, $file);

        return Redirect::back()->with('success', 'Data berhasil diimport');
    }

    public function menupdf()
    {
        $menu = menu::all();
        $pdf = Pdf::loadView('menu.pdf', compact('menu'));
    
        return $pdf->download('menu.pdf');
        // return redirect()->back();
    }
}
