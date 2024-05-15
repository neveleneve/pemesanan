<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class PemesananTable extends Component
{
    public $qtyMakan = [], $qtyMinum = [];

    public function render()
    {
        $makanan = Menu::where([
            'tipe' => 'makanan',
            'status' => 1
        ])->get();
        $minuman = Menu::where([
            'tipe' => 'minuman',
            'status' => 1
        ])->get();
        return view('livewire.pemesanan-table', [
            'makanan' => $makanan,
            'minuman' => $minuman,
        ]);
    }

    public function mount()
    {
        $makanan = Menu::where('tipe', 'makanan')->get();
        $minuman = Menu::where('tipe', 'minuman')->get();
        $i = 0;
        $j = 0;

        foreach ($makanan as $value) {
            $this->qtyMakan[$i] = 0;
            $i++;
        }
        foreach ($minuman as $value) {
            $this->qtyMinum[$j] = 0;
            $j++;
        }
    }
}
