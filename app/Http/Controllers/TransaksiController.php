<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksi;
use App\Models\transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use App\Models\DetailTransaksi;
use Exception;
use illuminate\Http\Request;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDOException;

class TransaksiController extends Controller
{


    public function storeTransaksi(StoreTransaksi $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            

            $last_id = Transaksi::whereDate('tanggal', today())->orderBy('id', 'desc')->first();
            $last_id_number = $last_id ? substr($last_id->id, 8) : 0;
            $notrans = today()->format('Ymd') . str_pad($last_id_number + 1, 4, '0', STR_PAD_LEFT);

            $insertTransaksi = Transaksi::create([
                'id' => $notrans,
                'tanggal' => date('Y-m-d'),
                'total_harga' => $validated['total'],
                'metode_pembayaran' => 'cash',
                'keterangan' => ''
            ]);


            // input detail transaksi 
            foreach ($validated['orderedList'] as $detail) {
                DetailTransaksi::create([
                    'transaksi_id' => $insertTransaksi->id,
                    'menu_id' => $detail['menu_id'],
                    'jumlah' => $detail['qty'],
                    'subtotal' => $detail['harga'] * $detail['qty']

                ]);
            }

            DB::commit();
            return response()->json(['status' => true, 'massage' => 'Pemesanan berhasil!', 'notrans' => $notrans]);
        } catch (Exception | QueryException | PDOException $e) {
            return response()->json(['status' => false, 'message' => 'Pemesanan Gagal', 'error' => $e->getMessage()]);
            DB::rollBack();
        }
    }

    public function faktur($nofaktur)
    {
        try {
            $data['transaksi'] = Transaksi::where('id', $nofaktur)->with(['detailTransaksi' => function ($query) {
                $query->with('menu');
            }])->first();

            return view('cetak.faktur')->with($data);
        } catch (Exception | QueryException | PDOException $e) {
            dd($e);
            return response()->json(['status' => false, 'massage' => 'Pemesanan Gagal']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetransaksiRequest $request, transaksi $transaksi)
    {
        try {
            DB::beginTransaction();
            $transaksi = transaksi::findOrFail($transaksi);
            $validate = $request->validated();
            $transaksi->update($validate);
            DB::commit();
            return redirect()->back()->with('success', 'data berhasil di ubah');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['message' => 'terjadi kesalahan']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi $transaksi)
    {
        try {
            $transaksi->delete();
            return redirect('/transaksi')->with('success', 'Data berhasil dihapus!');
        } catch (QueryException | Exception | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
    }

    public function idGen()
    {
        $notransToday = now()->format('Ymd');
        $lastCustomID = Transaksi::where('tanggal', $notransToday)->orderBy('id')->first();

        if ($lastCustomID) {
            $lastId = substr($lastCustomID->id, -4);
            $newId = $notransToday . str_pad((intval($lastId) + 1), 4, '0', STR_PAD_LEFT);
        } else {
            $newId = $notransToday . '0001';
        }
        return $newId;
    }
}
