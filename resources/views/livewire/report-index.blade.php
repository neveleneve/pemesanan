<div class="row">
    <form action="{{ route('report.cetak') }}" method="post" target="__blank">
        @csrf
        <div class="col-12 mb-3 text-center">
            <label for="jenis" class="fw-bold">Jenis Report</label>
            <select name="jenis" id="jenis" class="form-select form-select-sm" wire:model.live='jenis' required>
                <option selected hidden value="">Pilih Jenis Report</option>
                <option value="harian">Harian</option>
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
            </select>
        </div>
        <div class="col-12 mb-3 text-center" {{ $jenis != 'harian' ? 'hidden' : null }}>
            <label for="tanggal" class="fw-bold">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control form-control-sm"
                value="{{ date('Y-m-d') }}">
        </div>
        <div class="col mb-3 text-center" {{ $jenis != 'bulanan' ? 'hidden' : null }}>
            <label for="bulan" class="fw-bold">Bulan</label>
            <select name="bulan" id="bulan" class="form-select form-select-sm">
                <option selected hidden>Pilih Bulan</option>
                <option value="1" {{ 1 == date('n') ? 'selected' : null }}>Januari</option>
                <option value="2" {{ 2 == date('n') ? 'selected' : null }}>Februari</option>
                <option value="3" {{ 3 == date('n') ? 'selected' : null }}>Maret</option>
                <option value="4" {{ 4 == date('n') ? 'selected' : null }}>April</option>
                <option value="5" {{ 5 == date('n') ? 'selected' : null }}>Mei</option>
                <option value="6" {{ 6 == date('n') ? 'selected' : null }}>Juni</option>
                <option value="7" {{ 7 == date('n') ? 'selected' : null }}>Juli</option>
                <option value="8" {{ 8 == date('n') ? 'selected' : null }}>Agustus</option>
                <option value="9" {{ 9 == date('n') ? 'selected' : null }}>September</option>
                <option value="10" {{ 10 == date('n') ? 'selected' : null }}>Oktober</option>
                <option value="11" {{ 11 == date('n') ? 'selected' : null }}>November</option>
                <option value="12" {{ 12 == date('n') ? 'selected' : null }}>Desember</option>
            </select>
        </div>
        <div class="col mb-3 text-center" {{ $jenis == 'harian' || $jenis == null ? 'hidden' : null }}>
            <label for="tahun" class="fw-bold">Tahun</label>
            <select name="tahun" id="tahun" class="form-select form-select-sm">
                <option selected hidden>Pilih Tahun</option>
                @php
                    $tahun = date('Y');
                @endphp
                @for ($i = 0; $i < 5; $i++)
                    <option value="{{ $tahun - $i }}" {{ $tahun - $i == date('Y') ? 'selected' : null }}>
                        {{ $tahun - $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-12 gap-2 d-grid">
            <button class="btn btn-sm btn-outline-primary fw-bold" type="submit">
                Cetak
            </button>
        </div>
    </form>
</div>
