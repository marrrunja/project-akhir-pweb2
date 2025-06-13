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
            <th class="py-4">{{ $loop->iteration }}</th>
            <td class="py-4">{{ $product->nama }}</td>
            <td class="py-4">{{ $product->detail }}</td>
            <td class="py-4">{{ $product->kategori }}</td>
            <td class="py-4"><img src="{{ asset('storage/images/' . $product->foto) }}" width="100"></td>
            <td class="py-4">
                <a href="{{ route('admin.detailProduk', $product->id) }}" class="btn btn-primary">Lihat variant produk</a>
                <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
