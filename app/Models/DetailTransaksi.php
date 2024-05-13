<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'menu_id',
        'harga',
        'qty',
        'subtotal',
        'status',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
