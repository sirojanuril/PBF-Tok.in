<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Pesanan;
Use App\PesananDetail;

class PenjualanController extends Controller
{
    public function data_jualan()
    {
    	$pesanan_detail = PesananDetail::orderBy('created_at', 'desc')->get();    	

    	return view('penjualan.data_penjualan', compact('pesanan_detail'));
    }

    public function cetak_laporan($tanggal_awal, $tanggal_akhir)
    {

        $cetak_pertanggal = PesananDetail::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

        return view('penjualan.laporan', compact('cetak_pertanggal', 'tanggal_awal', 'tanggal_akhir'));
    }
}
