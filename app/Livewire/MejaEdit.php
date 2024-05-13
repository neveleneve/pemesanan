<?php

namespace App\Livewire;

use App\Models\Meja;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class MejaEdit extends Component
{
    public $meja_id;
    public $meja;

    public function render()
    {
        $this->meja = $this->getData();
        return view('livewire.meja-edit');
    }

    public function generateNewToken()
    {
        Alert::success('Berhasil', 'Berhasil mengupdate token baru!');
    }

    public function getData()
    {
        $meja = Meja::find($this->meja_id);
        return [
            'nama' => $meja->nama,
            'token' => $meja->token,
        ];
    }

    public function refreshed()
    {
        $meja = Meja::find($this->meja_id);
        $nama = $meja->nama;
        $hash = uuid_generate_sha1(uuid_create(UUID_TYPE_NAME), $nama);

        $update = $meja->update([
            'token' => str_replace('-', '', $hash)
        ]);

        if ($update) {
            $this->dispatch('generateToken', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Berhasil memperbarui token meja!',
            ]);
        } else {
            $this->dispatch('generateToken', [
                'icon' => 'error',
                'title' => 'Gagal',
                'text' => 'Gagal memperbarui token meja',
            ]);
        }
    }
}
