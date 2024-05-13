<?php

namespace App\Livewire;

use App\Models\Meja;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class MejaIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $dataPerPage = 10;
    public $currentPage;

    public function render()
    {
        if ($this->search == '') {
            $data = Meja::withTrashed()
                ->orderBy('deleted_at')
                ->paginate($this->dataPerPage);
        } else {
            $data = Meja::withTrashed()
                ->where('nama', 'LIKE', '%' . $this->search . '%')
                ->orderBy('deleted_at')
                ->paginate($this->dataPerPage);
        }
        return view('livewire.meja-index', [
            'meja' => $data
        ]);
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function restoreMeja($id)
    {
        $data = Meja::withTrashed()->find($id);
        $this->dispatch('restoreMeja', [
            'id' => $id,
            'nama' => strtolower($data->nama),
        ]);
    }
}
