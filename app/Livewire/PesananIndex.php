<?php

namespace App\Livewire;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class PesananIndex extends Component {
    use WithPagination;

    public $search = '';

    public function render() {
        $makanan = DetailTransaksi::with('menu', 'transaksi')
            ->whereHas('menu', function ($q) {
                $q->where('tipe', 'makanan');
            })
            ->where('status', 0)
            ->orderBy('created_at')
            ->get();
        $minuman = DetailTransaksi::with('menu', 'transaksi')
            ->whereHas('menu', function ($q) {
                $q->where('tipe', 'minuman');
            })
            ->where('status', 0)
            ->orderBy('created_at')
            ->get();
        return view('livewire.pesanan-index', [
            'makanan' => $makanan,
            'minuman' => $minuman,
        ]);
    }

    public function confirmDone($id) {
        $detail = DetailTransaksi::with('transaksi', 'transaksi.meja', 'menu')->find($id);
        $data = [
            'id' => $id,
            'title' => 'Selesaikan pesanan ' . $detail->menu->nama . ' untuk ' . $detail->transaksi->meja->nama . '?',
        ];
        $this->dispatch('confirm', data: $data);
    }

    #[On('confirmed_done')]
    public function doneOrder($id) {
        $trx = DetailTransaksi::find($id);
        $update = $trx->update([
            'status' => 1
        ]);
        if ($update) {
            $jmlPesan = DetailTransaksi::where([
                'transaksi_id' => $trx->transaksi_id
            ])->count();
            $jmlPesanDone = DetailTransaksi::where([
                'transaksi_id' => $trx->transaksi_id,
                'status' => 1,
            ])->count();
            if ($jmlPesan == $jmlPesanDone) {
                Transaksi::where('id', $trx->transaksi_id)->update([
                    'status' => 1
                ]);
            }
            $data = [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil menyelesaikan pesan!'
            ];
        } else {
            $data = [
                'icon' => 'warning',
                'title' => 'Gagal',
                'text' => 'Gagal menyelesaikan pesan! Silakan ulangi!'
            ];
        }
        $this->dispatch('alert', data: $data);
    }
}
