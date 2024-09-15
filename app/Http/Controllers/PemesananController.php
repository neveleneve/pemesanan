<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Meja;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananController extends Controller {
    public function __construct() {
        $this->middleware('guest');
    }

    public function pesan($meja, $token) {
        $data = Meja::find($meja);
        if ($data) {
            if ($token == $data->token) {
                return view('user.pemesanan.check', [
                    'meja_id' => $data->id,
                    'meja_token' => $data->token,
                ]);
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function pemesanan(Request $request) {
        $data = Meja::find($request->meja_id);
        if ($data) {
            if ($request->meja_token == $data->token) {
                return view('user.pemesanan.index', [
                    'data' => $data,
                ]);
            } else {
                return view('errors.404');
            }
        } else {
            return view('errors.404');
        }
    }

    public function hasilpesan(Request $request, $kode) {
        $data = Transaksi::with(['meja', 'detail_transaksi', 'detail_transaksi.menu'])
            ->where('kode', $kode)
            ->first();
        if ($data) {
            $totalEstimatedTime = 0;
            foreach ($data->detail_transaksi as $detail) {
                for ($i = 0; $i < $detail->qty; $i++) {
                    $totalEstimatedTime += $detail->menu->estimasi_waktu;
                }
            }
            if (session('alert')) {
                Alert::success('Berhasil Membuat Pesanan', 'Pesanan kamu berhasil dipesan. Silahkan menunggu waiters kami untuk mengantar pesanan kamu!');
            }
            return view('user.pemesanan.view', [
                'data' => $data,
                'time_estimated' => $totalEstimatedTime
            ]);
        } else {
            return view('errors.404');
        }
    }
}
