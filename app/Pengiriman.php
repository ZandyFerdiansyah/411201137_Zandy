<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = "pengiriman";

    protected $fillable = [
    'no_pengiriman', 'tanggal', 'lokasi_id','barang_id','jumlah_barang','harga_barang','kurir_id','status'
    ];
}
