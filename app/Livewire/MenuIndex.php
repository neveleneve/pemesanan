<?php

namespace App\Livewire;

use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class MenuIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $dataPerPage = 10;
    public $currentPage;

    public function render()
    {
        if ($this->search == '') {
            $data = Menu::withTrashed()
                ->orderBy('deleted_at')
                ->paginate($this->dataPerPage);
        } else {
            $data = Menu::withTrashed()
                ->where('nama', 'LIKE', '%' . $this->search . '%')
                ->orderBy('deleted_at')
                ->paginate($this->dataPerPage);
        }
        return view('livewire.menu-index', [
            'menu' => $data
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
