<table class="table">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Varian</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->variant->produk->nama_produk ?? 'Nama Produk' }}</td>
                <td>{{ $item->variant->variant }}</td>
                <td>Rp{{ number_format($item->variant->harga) }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.update', $item->id) }}">
                        @csrf
                        <input type="number" name="qty" value="{{ $item->qty }}" min="1">
                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>Rp{{ number_format($item->variant->harga * $item->qty) }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.delete', $item->id) }}">
                        @csrf
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
