<table class="table">
    <thead>
        <th>#</th>
        <th>Tanggal transaksi</th>
        <th>Nama Pengguna</th>
        <th>Dibayar</th>
        <th>Detail</th>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $order->tanggal_transaksi }}</td>
            <td>{{ $order->username }}</td>
            <td>{{ $order->is_dibayar === 0 ? 'Belum' : 'Sudah dibayar' }}</td>
            <td><a href="{{ route('admin.detailOrder', $order->id) }}">Detail Order</a></td>
        </tr>
        @endforeach
    </tbody>
</table>