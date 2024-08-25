<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk {{ $transaksi['kode'] }}</title>
    <style>
        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
            margin-right: 1em;
        }

        .h1 {
            font-size: 28px;
            letter-spacing: 1px;
        }

        .h2 {
            font-size: 24px;
            letter-spacing: 1px;
        }

        .h3 {
            font-size: 20px;
            letter-spacing: 1px;
        }

        .h4 {
            font-size: 16px;
            letter-spacing: 1px;
        }

        .h5 {
            font-size: 12px;
            letter-spacing: 1px;
        }

        .h6 {
            font-size: 8px;
            letter-spacing: 1px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mb-1 {
            margin-bottom: 20px;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .mt-1 {
            margin-top: 20px;
        }

        .table {
            border-collapse: collapse
        }

        .table-center {
            margin-left: auto;
            margin-right: auto;
        }

        .table td,
        .table th {
            text-align: center;
            padding: 5px 10px;
            border: 1px solid #333;
        }

        .w-25 {
            width: 25%;
        }

        .w-50 {
            width: 50%;
        }

        .w-75 {
            width: 75%;

        }

        .w-100 {
            width: 100%;

        }
    </style>
</head>

<body>
    <p class="text-center h4 fw-bold mb-0">
        Struk Pembayaran
    </p>
    <br>
    <br>
    <table class="table-center w-50 h5">
        <tbody>
            <tr>
                <td class="fw-bold">Kode Pesanan</td>
                <td>:</td>
                <td>{{ $transaksi['kode'] }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Nama Pemesan</td>
                <td>:</td>
                <td>{{ ucwords($transaksi['nama']) }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Meja</td>
                <td>:</td>
                <td>{{ $transaksi['meja'] }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Total Bayar</td>
                <td>:</td>
                <td>Rp. {{ number_format($transaksi['total'], 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="table w-100 h5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp. {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td style="text-align: right">Rp. {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
