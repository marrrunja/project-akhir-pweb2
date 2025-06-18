<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Penjualan</title>
    <style>
        body {
            font-family: 'helvetica', 'arial', 'sans-serif';
        }

        h1 {
            margin-bottom: 3rem;
            text-align: center;
        }

        .container {
            width: 100%;
            float: left;
        }

        .card {
            float: left;
            width: 250px;
            height: auto;
            border: 1px solid #ddd;
            overflow: hidden;
            margin-bottom: 1rem;
            margin-left: 4.2rem;
            margin-right: 1rem;
        }

        .card .img-card-top {
            width: 100%;
            height: 100px;
            object-fit: cover !important;
        }

        .card .card-body {
            padding: 1rem;
        }

        .clear {
            clear: both;
        }

    </style>
</head>

<body>
    <h1>Detail Order</h1>
    <div class="container">
        @foreach($details as $detail)
        <div class="card">
            <img src="storage/image-variant/{{ $detail->foto }}" alt="{{ $detail->nama }} {{ $detail->variant }}"
                class="img-card-top">
            <div class="card-body">
                <table>
                    <tr>
                        <td><strong>{{ $detail->nama }} {{ $detail->variant }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>{{ number_format($detail->harga,0,',','.') }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>{{ $detail->jumlah }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td>{{ number_format($detail->total_harga,0,',','.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
        <div class="clear"></div>

    </div>
</body>

</html>
