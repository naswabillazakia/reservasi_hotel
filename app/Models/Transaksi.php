<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable =[
        'nama_tamu_hotel', 'email', 'jumlah_orang', 'jenis_fasilitas_kamar', 'tanggal_reservasi', 'tanggal_check_out', 'jumlah_hari'
    ];
}
