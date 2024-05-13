<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $dataPerPage = 10;
    public $currentPage;

    public function render()
    {
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

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
