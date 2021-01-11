<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Pesanan;
Use App\PesananDetail;
use App\User;
use App\Transaksi;
use Auth;
use Alert;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function riwayat_pembelian()
    {
    	$pesanan = Pesanan::where('user_id', auth::user()->id)->where('status_pesanan', '!=', "proses")->latest()->paginate(5);        
    	return view('transaksi.riwayat', compact('pesanan'));
    }

    public function info($id)
    {
    	$pesanan           = Pesanan::where('id', $id)->first();
    	$pesanan_detail    = PesananDetail::where('pesanan_id', $pesanan->id)->get();

    	return view('transaksi.info', compact('pesanan', 'pesanan_detail'));
    }

    
    public function bayar_pesanan($id)
    {
        $pesanan    = Pesanan::where('id', $id)->first();
        $transaksi  = Transaksi::where('pesanan_id', $pesanan->id)->first();
        return view('transaksi.bayar', compact('pesanan', 'transaksi'));
    }

    public function upload_bukti(Request $request, $id)
    {

        $pesanan = Pesanan::where('id', $id)->first();
        $bukti = Transaksi::where('pesanan_id', $pesanan->id)->first();
        
        $request->validate([
                'bukti_pembayaran'        => 'required|mimes:jpeg,png,jpg|max:2048',
            ]);

        $transaksi = new Transaksi;
        $transaksi->pesanan_id          = $pesanan->id;
        $transaksi->status_pembayaran   = "Sudah Bayar";

        if ($request->hasfile('bukti_pembayaran')) {
            $bukti_bayar                    = $request->file('bukti_pembayaran');
            $bukti_bayar_pesanan            = rand().'.'.$bukti_bayar->getClientOriginalExtension();
            $bukti_bayar->storeAs('pembayaran', $bukti_bayar_pesanan);
            $transaksi->bukti_pembayaran    = $bukti_bayar_pesanan;
            $pesanan->status_pesanan        = "Belum Diverifikasi";
            $pesanan->update();
        }

        $transaksi->save();

        return redirect('riwayat')->with('success', 'Berhasil melakukan pembayaran, Silahkan menunggu verifikasi');   
    }

    public function pesanan_pembeli()
    {
        // $pesanan = Pesanan::all();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->first();
        $transaksi = Transaksi::latest()->paginate(8);

        return view('transaksi.pesanan', compact('transaksi', 'pesanan'));
    }

    public function info_pembeli($id)
    {
        $user = User::find($id);

        return view('transaksi.detail_pembeli', compact('user'));
    }


    public function verifikasi(Request $request, $id)
    {
        $pesanan                    = Pesanan::where('id', $request->id)->first();
        // $pesanan->status_pesanan    = $request->status_pesanan;
        if ($request->status_pesanan == "pesan") {
            $pesanan->status_pesanan = "Belum Diverifikasi";
        }else{
            $pesanan->status_pesanan    = $request->status_pesanan;
        }

        $pesanan->update();

        return redirect('pesanan')->with('success', 'Berhasil verifikasi pesanan');
    }
}
