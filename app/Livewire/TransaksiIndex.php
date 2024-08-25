<?php

namespace App\Livewire;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiIndex extends Component {
    use WithPagination;

    public $search = '';

    public $dataPerPage = 10;
    public $currentPage;

    public $selectedTrx = [
        'id' => 0,
        'kode' => '',
        'nama' => '',
        'meja' => '',
        'total' => 0,
        'status' => '',
        'status bayar' => '',
    ];
    public $details = [];

    public function render() {
        if ($this->search == '') {
            $data = Transaksi::with('meja')
                ->orderBy('created_at', 'desc')
                ->paginate($this->dataPerPage);
        } else {
            $data = Transaksi::with('meja')
                ->where('kode', 'LIKE', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->orWhere('nama', 'LIKE', '%' . $this->search . '%')
                ->paginate($this->dataPerPage);
        }
        return view('livewire.transaksi-index', [
            'transaksi' => $data
        ]);
    }

    public function setPage($url) {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function transaksiDetail(Transaksi $transaksi) {
        $this->selectedTrx = [
            'id' => $transaksi->id,
            'kode' => $transaksi->kode,
            'nama' => $transaksi->nama,
            'meja' => $transaksi->meja->nama,
            'total' => $transaksi->total,
            'status' => $transaksi->status,
            'status bayar' => $transaksi->status_bayar,
        ];
        $menu = $transaksi->detail_transaksi()->get();
        $data = [];
        foreach ($menu as $key => $value) {
            $data[$key] = [
                'nama' => $value->menu->nama,
                'qty' => $value->qty,
                'status' => $value->status,
                'harga' => $value->harga,
                'subtotal' => $value->subtotal,
            ];
        }
        $this->details = $data;
    }

    public function cetak(Transaksi $transaksi) {
        $route = route('transaksi.report', [
            'id' => $transaksi->id,
            'kode' => $transaksi->kode,
        ]);

        $this->dispatch('open-report', route: $route);
    }
}
