<div class="row justify-content-center mb-3">
    <div class="col-12">
        <ul class="nav nav-underline justify-content-center">
            @can('dashboard index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard*') ? 'active fw-bold' : 'text-dark' }}"
                        href="{{ route('dashboard') }}" wire:navigate>
                        Dashboard
                    </a>
                </li>
            @endcan
            @can('user index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('user*') || Request::is('role*') ? 'active fw-bold' : 'text-dark' }}"
                        href="{{ route('user.index') }}" wire:navigate>
                        Pengguna
                    </a>
                </li>
            @endcan
            @can('meja index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('meja*') ? 'active fw-bold' : 'text-dark' }}"
                        href="{{ route('meja.index') }}" wire:navigate>
                        Meja
                    </a>
                </li>
            @endcan
            @can('menu index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('menu*') ? 'active fw-bold' : 'text-dark' }}"
                        href="{{ route('menu.index') }}" wire:navigate>
                        Menu
                    </a>
                </li>
            @endcan
            @can('transaksi index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('transaksi*') ? 'active fw-bold' : 'text-dark' }}"
                        href="{{ route('transaksi.index') }}" wire:navigate>
                        Transaksi
                    </a>
                </li>
            @endcan
            @can('pesanan index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('pesanan*') ? 'active fw-bold' : 'text-dark' }}"
                        href="{{ route('pesanan.index') }}" wire:navigate>
                        Pesanan
                    </a>
                </li>
            @endcan
            {{-- @can('report index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('report*') ? 'active fw-bold' : 'text-dark' }}"
                        href="{{ route('transaksi.index') }}">
                        Report
                    </a>
                </li>
            @endcan --}}
        </ul>
        <hr class="m-0">
    </div>
</div>
