<table class="table">
    <thead>
        <th>#</th>
        <th>Nama</th>
        <th>Detail</th>
        <th>Kategori</th>
        <th>Foto</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $product->nama }}</td>
            <td>{{ $product->detail }}</td>
            <td>{{ $product->kategori }}</td>
            <td><img src="{{ asset('storage/images/' . $product->foto) }}" width="100"></td>
            <td class="d-flex gap-3">
                <a href="{{ route('admin.detailProduk', $product->id) }}" class="btn btn-primary">Lihat variant produk</a>
                <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
