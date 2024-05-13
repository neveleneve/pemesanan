<div>
    <form action="{{ route('meja.store') }}" method="post">
        @csrf
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label col-form-label-sm fw-bold">Nama
                Menu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                    id="nama" name="nama" placeholder="Nama Menu" readonly wire:model='datas.nama'>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="token" class="col-sm-2 col-form-label col-form-label-sm fw-bold">Token</label>
            <div class="col-sm-10">
                <div class="input-group mb-3">
                    <button class="btn btn-outline-warning btn-sm" type="button" title="refresh"
                        wire:click='refreshed()'>
                        <i class="fa-solid fa-arrows-rotate" wire:loading.remove></i>
                        <i class="fa-solid fa-arrows-rotate fa-spin" wire:loading></i>
                    </button>
                    <input type="text" class="form-control form-control-sm @error('token') is-invalid @enderror"
                        id="token" name="token" placeholder="Token" readonly wire:loading.attr='disabled'
                        wire:target='refreshed()' wire:model.live='datas.token'>
                </div>
                @error('token')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-12 d-grid gap-2">
                <button class="btn btn-sm btn-outline-primary fw-bold" type="submit">Simpan</button>
            </div>
        </div>
    </form>
</div>
