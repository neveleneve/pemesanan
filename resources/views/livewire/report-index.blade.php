<div class="row">
    <div class="col-12 mb-3 text-center">
        <label for="jenis" class="fw-bold">Jenis Report</label>
        <select name="jenis" id="jenis" class="form-select form-select-sm" wire:model.live='jenis'>
            <option selected hidden>Pilih Jenis Report</option>
            <option value="harian">Harian</option>
            <option value="bulanan">Bulanan</option>
            <option value="tahunan">Tahunan</option>
        </select>
    </div>
    <div class="col-12 mb-3 text-center" {{ $jenis != 'harian' ? 'hidden' : null }}>
        <label for="tanggal" class="fw-bold">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" class="form-control form-control-sm">
    </div>
    <div class="col mb-3 text-center" {{ $jenis != 'bulanan' ? 'hidden' : null }}>
        <label for="bulan" class="fw-bold">Bulan</label>
        <select name="bulan" id="bulan" class="form-select form-select-sm">
            <option selected hidden>Pilih Bulan</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
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
                <option value="{{ $tahun - $i }}">{{ $tahun - $i }}</option>
            @endfor
        </select>
    </div>
    <div class="col-12 gap-2 d-grid">
        <button class="btn btn-sm btn-outline-primary fw-bold" type="submit">
            Cetak
        </button>
    </div>
</div>
