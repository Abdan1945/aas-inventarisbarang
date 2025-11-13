<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('details.barang')->latest()->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('transaksi.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis'     => 'required|in:masuk,keluar',
            'tanggal'   => 'required|date',
            'barang_id' => 'required|array',
            'jumlah'    => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $kode = 'TRX' . date('Ymd') . '-' . Str::upper(Str::random(4));

            $transaksi = Transaksi::create([
                'kode_transaksi' => $kode,
                'tanggal'        => $request->tanggal,
                'jenis'          => $request->jenis,
                'keterangan'     => $request->keterangan,
            ]);

            foreach ($request->barang_id as $i => $barangId) {
                $jumlah = $request->jumlah[$i];

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id'    => $barangId,
                    'jumlah'       => $jumlah,
                ]);

                $barang = Barang::find($barangId);
                if ($request->jenis === 'masuk') {
                    $barang->stok += $jumlah;
                } else {
                    $barang->stok -= $jumlah;
                }
                $barang->save();
            }
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan');
    }
}
