<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Pesanan;
Use App\PesananDetail;
use App\User;
use Carbon\Carbon;
use Auth;
// use Alert;


class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pesanan_barang($id)
    {
    	$barang = Barang::where('id', $id)->first();
    	return view('pesan.jumlah_pesanan', compact('barang'));
    }

    public function pemesanan(Request $request, $id)
    {
    	$barang 	= Barang::where('id', $id)->first();
    	$tanggal 	= Carbon::now();


    	if ($request->jumlah_pesan > $barang->stok_barang) {
    		return redirect('pesan/'.$id)->with('danger', 'Stok barang tidak mencukupi pembelian anda');
    	}

        if ($request->jumlah_pesan == 0) {
            return redirect('pesan/'.$id)->with('danger', 'Tidak boleh membeli dengan jumlah 0');
        }

    	$cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "proses")->first();

    	if (empty($cek_pesanan)) {
    		$pesanan = new Pesanan;
	    	$pesanan->user_id 			= Auth::user()->id;
	    	$pesanan->tanggal_pesanan 	= $tanggal;
	    	$pesanan->status_pesanan 	= "proses";
	    	$pesanan->jumlah_harga 		= 0;
	    	$pesanan->save();
    	}
    	
    	$pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "proses")->first();

    	$cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();

    	if (empty($cek_pesanan_detail)) {
    		$pesanan_detail = new PesananDetail;
	    	$pesanan_detail->barang_id 		         = $barang->id;
	    	$pesanan_detail->pesanan_id 	         = $pesanan_baru->id;
	    	$pesanan_detail->jumlah_barang 	         = $request->jumlah_pesan;
	    	$pesanan_detail->jumlah_harga_barang 	 = $barang->harga_barang * $request->jumlah_pesan;
	    	$pesanan_detail->save();
    	}else{
    		$pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();

    		$pesanan_detail->jumlah_barang        = $pesanan_detail->jumlah_barang + $request->jumlah_pesan;
    		$harga_pesanan_detail_baru            = $barang->harga_barang * $request->jumlah_pesan;
	    	$pesanan_detail->jumlah_harga_barang  = $pesanan_detail->jumlah_harga_barang + $harga_pesanan_detail_baru;
	    	$pesanan_detail->update();
    	}

    	$pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "proses")->first();
    	$pesanan->jumlah_harga = $pesanan->jumlah_harga + $barang->harga_barang * $request->jumlah_pesan;
    	$pesanan->update();
    	
    	return redirect('beli')->with('success', 'Barang berhasil dipesan');
    }

    public function pembelian()
    {
    	$pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "proses")->first();
    	$pesanan_details = [];

    	if (!empty($pesanan)) {
    		$pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->latest()->get();
    	}
    	
    	return view('pesan.beli', compact('pesanan', 'pesanan_details'));
    }

    public function delete($id)
    {
        
    	$pesanan_detail = PesananDetail::where('id', $id)->first();
    	$pesanan               = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
    	$pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga_barang;
    	$pesanan->update();

    	$pesanan_detail->delete();

    	return redirect('beli')->with('success', 'Barang berhasil dihapus dari pemesanan sementara');
    }

    public function pembayaran()
    {
        $user = User::where('id', Auth::user()->id)->first();

        if (empty($user->alamat)) {
            return redirect('akun')->with('danger', 'Data harus lengkap terlebih dahulu');
        }

        if (empty($user->no_hp)) {
            return redirect('akun')->with('danger', 'Data harus lengkap terlebih dahulu');
        }

        if (empty($user->jenis_kelamin)) {
            return redirect('akun')->with('danger', 'Data harus lengkap terlebih dahulu');
        }

        if (empty($user->tanggal_lahir)) {
            return redirect('akun')->with('danger', 'Data harus lengkap terlebih dahulu');
        }

    	$pesanan                   = Pesanan::where('user_id', Auth::user()->id)->where('status_pesanan', "proses")->first();
    	$pesanan_id                = $pesanan->id;
    	$pesanan->status_pesanan   = "pesan";
    	$pesanan->update();

    	$pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();

    	foreach ($pesanan_details as $pesanan_detail) {
    		$barang               = Barang::where('id', $pesanan_detail->barang_id)->first();
    		$barang->stok_barang  = $barang->stok_barang-$pesanan_detail->jumlah_barang;
    		$barang->update(); 
    	}

    	return redirect('riwayat/'.$pesanan_id)->with('success', 'Barang berhasil dibeli, silahkan melakukan pembayaran');
    }

}
