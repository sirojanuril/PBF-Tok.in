<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table 		= 'transaksi';
    protected $primaryKey 	= 'id';
    protected $fillable 	= ['bukti_pembayaran', 'status_pembayaran'];

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan');
    }
}
