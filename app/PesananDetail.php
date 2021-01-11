<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $table 		= 'pesanan_detail';
    protected $primaryKey 	= 'id';
    protected $fillable 	= ['jumlah_barang', 'jumlah_harga_barang'];

    public function barang()
	{
	    return $this->belongsTo('App\Barang', 'barang_id', 'id');
	}

	public function pesanan()
	{
	    return $this->belongsTo('App\Pesanan', 'pesanan_id', 'id');
	}

	public function total_penjualan()
    {
        return $this->sum('jumlah_harga_barang');
    }

    public function filter_total($tanggal_awal, $tanggal_akhir)
    {
        return $this->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->sum('jumlah_harga_barang');
    }

    public function barang_terjual()
    {
        return $this->sum('jumlah_barang');
    }

    public function filter_total_barang($tanggal_awal, $tanggal_akhir)
    {
        return $this->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->sum('jumlah_barang');
    }

}
