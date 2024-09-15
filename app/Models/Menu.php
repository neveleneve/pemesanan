<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'images',
        'nama',
        'harga',
        'tipe',
        'estimasi_waktu',
        'status',
    ];

    public function detail_transaksi() {
        return $this->hasMany(DetailTransaksi::class);
    }
}
