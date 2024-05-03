<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\menu;
use App\Models\pelanggan;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class DataController extends Controller
{
    public function index(){
        $menu = menu::get();
        $data['count_menu'] = $menu ->count();

        $detailTransaksi = DetailTransaksi::get();
        $totalPendapatan = $detailTransaksi->groupBy(function ($date){
            return Carbon::parse($date->tanggal)->format('m/d');
        })->map(function ($groupedItems){
            return $groupedItems->sum('subtotal');
        });


        
        //tampilkan 10 data pelanggan terakhir
        // $data['pelanggan'] = pelanggan::limit(0, 10)->sortBy('created_at','desc')->get();
        $data = [
            'totalPendapatan' => $totalPendapatan->sum(),
        ];
        return view('data')->with($data);
        $totalPendapatan = $totalPendapatan();
    }

    
}
