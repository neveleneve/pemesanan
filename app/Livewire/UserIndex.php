<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $dataPerPage = 10;
    public $currentPage;

    public function render()
    {
        if ($this->search == '') {
            $data = User::with('roles')
                ->withTrashed()
                ->orderBy('deleted_at')
                ->paginate($this->dataPerPage);
        } else {
            $data = User::with('roles')
                ->withTrashed()
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->orderBy('deleted_at')
                ->paginate($this->dataPerPage);
        }
        return view('livewire.user-index', [
            'user' => $data
        ]);
    }


    public function restoreUser($id)
    {
        $data = User::withTrashed()->find($id);
        $this->dispatch('restoreUser', [
            'id' => $id,
            'nama' => $data->name,
        ]);
    }
}
