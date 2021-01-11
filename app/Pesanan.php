<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
	protected $table 		= 'pesanan';
    protected $primaryKey 	= 'id';
    protected $fillable 	= ['tanggal_pesanan', 'status_pesanan', 'jumlah_harga'];

    public function user()
	{
	    return $this->belongsTo('App\Pesanan', 'user_id', 'id');
	}

	public function pesanan_detail()
    {
        return $this->hasMany('App\PesananDetail', 'pesanan_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Transaksi', 'transaksi_id');
    }
}
