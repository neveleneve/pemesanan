<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class PemesananTable extends Component {
    public $data;
    public $nama;
    public $meja_name, $meja_id, $meja_token;
    public $qtyMakan = [], $qtyMinum = [];
    public $estimated_time = 0;

    public function render() {
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

    public function mount() {
        $makanan = Menu::where([
            'tipe' => 'makanan',
            'status' => 1
        ])->get();
        $minuman = Menu::where([
            'tipe' => 'minuman',
            'status' => 1
        ])->get();
        $i = 0;
        $j = 0;

        foreach ($makanan as $makan) {
            $this->qtyMakan[$i]['id'] = $makan->id;
            $this->qtyMakan[$i]['images'] = $makan->images;
            $this->qtyMakan[$i]['estimasi_waktu'] = $makan->estimasi_waktu;
            $this->qtyMakan[$i]['qty'] = 0;
            $i++;
        }

        foreach ($minuman as $minum) {
            $this->qtyMinum[$j]['id'] = $minum->id;
            $this->qtyMinum[$j]['images'] = $minum->images;
            $this->qtyMinum[$j]['estimasi_waktu'] = $minum->estimasi_waktu;
            $this->qtyMinum[$j]['qty'] = 0;
            $j++;
        }
    }

    public function subTotal($id, $qty) {
        $menu = Menu::find($id);
        $nama = $menu->nama;
        $harga = $menu->harga;
        $subtotal = $menu->harga * $qty;
        return [
            'nama' => $nama,
            'harga' => $harga,
            'subtotal' => $subtotal
        ];
    }

    public function grandTotal() {
        $makan = $this->qtyMakan;
        $minum = $this->qtyMinum;
        $total = 0;
        foreach ($makan as  $mkn) {
            $subtotal = $this->subTotal($mkn['id'], $mkn['qty'])['subtotal'];
            $total += $subtotal;
        }
        foreach ($minum as  $mnm) {
            $subtotal = $this->subTotal($mnm['id'], $mnm['qty'])['subtotal'];
            $total += $subtotal;
        }
        return $total;
    }

    public function valueChanger($index, $type, $value) {
        if ($type == 'makan') {
            if ($value == '+') {
                $this->qtyMakan[$index]['qty'] += 1;
                $this->estimated_time += $this->qtyMakan[$index]['estimasi_waktu'];
            } elseif ($value == '-') {
                if (!$this->qtyMakan[$index]['qty'] == 0) {
                    $this->qtyMakan[$index]['qty'] -= 1;
                    $this->estimated_time -= $this->qtyMakan[$index]['estimasi_waktu'];
                }
            }
        } elseif ($type == 'minum') {
            if ($value == '+') {
                $this->qtyMinum[$index]['qty'] += 1;
                $this->estimated_time += $this->qtyMinum[$index]['estimasi_waktu'];
            } elseif ($value == '-') {
                if (!$this->qtyMinum[$index]['qty'] == 0) {
                    $this->qtyMinum[$index]['qty'] -= 1;
                    $this->estimated_time -= $this->qtyMinum[$index]['estimasi_waktu'];
                }
            }
        }
    }

    public function cancelPesan($type, $index) {
        if ($type == 'makan') {
            $this->qtyMakan[$index]['qty'] = 0;
        } elseif ($type == 'minum') {
            $this->qtyMinum[$index]['qty'] = 0;
        }
    }
}
