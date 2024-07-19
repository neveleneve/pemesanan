<?php

namespace App\Livewire;

use App\Models\Meja;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MejaIndex extends Component {
    use WithPagination;

    public $search = '';

    public $dataPerPage = 10;
    public $currentPage;

    public function render() {
        if ($this->search == '') {
            $data = Meja::paginate($this->dataPerPage);
        } else {
            $data = Meja::where('nama', 'LIKE', '%' . $this->search . '%')
                ->paginate($this->dataPerPage);
        }
        return view('livewire.meja-index', [
            'meja' => $data
        ]);
    }

    public function setPage($url) {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function restoreMeja($id) {
        $data = Meja::withTrashed()->find($id);
        $this->dispatch('restoreMeja', [
            'id' => $id,
            'nama' => strtolower($data->nama),
        ]);
    }

    public function qrCode(Meja $meja) {
        $id = $meja->id;
        $name = $meja->nama;
        $token = $meja->token;
        return response()->streamDownload(
            function () use ($id, $token) {
                echo QrCode::size(200)
                    ->format('png')
                    ->generate(route('pesan.check', ['meja' => $id, 'token' => $token]));
            },
            'QRCode-' . $name . '.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }
}
