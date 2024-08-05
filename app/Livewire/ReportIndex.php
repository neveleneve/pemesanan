<?php

namespace App\Livewire;

use Livewire\Component;

class ReportIndex extends Component {
    public $jenis = null;

    public function render() {
        return view('livewire.report-index');
    }
}
