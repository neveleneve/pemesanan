<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Tahunan - {{ $tahun }}</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap-minty.min.css') }}" rel="stylesheet">
    <style>
        /* Custom CSS for Bootstrap 5 Table */

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid text-center">
        <h1 class="display-1">Laporan Penjualan Tahunan</h1>
        <p class="lead">Tahun {{ $tahun }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Estimasi</th>
                    <th>Selesai</th>
                    <th>Nama Pengguna</th>
                    <th>Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                        <td>{{ date('d F Y H:i', strtotime($item->created_at)) }}</td>
                        <td>{{ round($item->detail_transaksi_sum_qty * 2.5) }} Menit</td>
                        <td>{{ date('d F Y H:i', strtotime($item->created_at . '+' . round($item->detail_transaksi_sum_qty * 2.5) * 60 . 'second')) }}
                        </td>
                        <td>{{ $item->nama }}</td>
                        <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $total += $item->total;
                    @endphp
                @empty
                    <tr>
                        <td colspan="8">
                            <h4 class="display-1 text-center">Data Transaksi Kosong</h4>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if (count($data) > 0)
                <tfoot>
                    <tr>
                        <td colspan="8" class="text-end">

                        </td>
                        <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
</body>

</html>
