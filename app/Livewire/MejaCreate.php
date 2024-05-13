<?php

namespace App\Livewire;

use App\Models\Meja;
use Livewire\Component;

class MejaCreate extends Component
{
    public $datas = [
        'nama',
        'token',
    ];
    public function render()
    {
        return view('livewire.meja-create');
    }

    public function mount()
    {
        $this->getNewData();
    }

    public function getNewData()
    {
        $this->datas = [
            'nama' => null,
            'token' => null,
        ];

        $jmlMeja = Meja::count();
        $nama = 'Meja ' . $jmlMeja + 1;
        $hash = uuid_generate_sha1(uuid_create(UUID_TYPE_NAME), $nama);

        $this->datas = [
            'nama' => $nama,
            'token' => str_replace('-', '', $hash),
        ];
    }

    function refreshed()
    {
        $this->getNewData();
    }
}
