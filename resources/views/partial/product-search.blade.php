<div class="table-responsive" id="content-produk">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Detail</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <th class="text-center align-middle">{{ $loop->iteration }}</th>
                <td class="text-center align-middle px-5">{{ $product->nama }}</td>
                <td class="text-center align-middle px-5">{{ $product->detail }}</td>
                <td class="text-center align-middle px-5">{{ $product->kategori }}</td>
                <td class="text-center align-middle px-5"><img src="{{ asset('storage/images/' . $product->foto) }}"
                        width="100">
                </td>
                <td class="text-center align-middle px-4">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            Klik
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('admin.detailProduk', $product->id) }}" class="dropdown-item fs-1">Lihat
                                variant produk</a>
                            <a href="{{ route('produk.edit', $product->id) }}" class="dropdown-item">Edit</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
