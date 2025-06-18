<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Penjualan</title>
    <style>
        body {
            font-family: 'helvetica', 'arial', 'sans-serif';
        }

        h1 {
            text-align:center;
        }
        table{
            width: 100%;
        }
        table,tr{
            border:1px solid black;
            border-collapse:collapse;
            text-align:center;
        }
        th,td{
            padding:10px;
        }
        thead tr th{
            vertical-align:center;
            text-align:center;
        }
        tbody tr:nth-child(even){
            background-color:#ddd;
        }
        table thead tr{
            background-color:#059862;
        }
        table thead tr th{
           color:white;
        }
        a{
            color:black;
        }

    </style>
</head>

<body>
    <h1>Laporan Penjualan</h1>
    <table cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal transaksi</th>
                <th>Nama Pengguna</th>
                <th>Dibayar</th>
                <th>Total</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->tanggal_transaksi }}</td>
                <td>{{ $order->username }}</td>
                <td>{{ $order->is_dibayar === 0 ? 'Belum' : 'Sudah dibayar' }}</td>
                <td>Rp {{ number_format($order->total_harga, 0,',','.') }}</td>
                <td><a href="/laporan/order-detail/{{ $order->id }}" target="_blank">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
