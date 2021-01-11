<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table 		= 'barang';
    protected $primaryKey 	= 'id';
    protected $fillable 	= ['nama_barang', 'harga_barang', 'stok_barang', 'keterangan', 'gambar'];

    public function pesanan_detail()
    {
        return $this->hasMany('App\PesananDetail', 'barang_id', 'id');
    }
}
