<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model {
    use HasFactory;

    protected $fillable = [
        'meja_id',
        'nama',
        'kode',
        'total',
        'status',
        'status_bayar',
    ];

    public function meja() {
        return $this->belongsTo(Meja::class)->withTrashed();
    }

    public function detail_transaksi() {
        return $this->hasMany(DetailTransaksi::class);
    }
}
