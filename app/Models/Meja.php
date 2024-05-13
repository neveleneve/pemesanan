<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meja extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'token',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
