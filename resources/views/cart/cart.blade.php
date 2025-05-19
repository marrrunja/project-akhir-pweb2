<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Keranjang Belanja</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Variant</th>
                            <th>Harga</th>
                            <th>Quantity</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $item)
                            <tr>
                                <td>{{ $item->variant->produk->nama_produk ?? 'Nama Produk' }}</td>
                                <td>{{ $item->variant->variant ?? 'Variant' }}</td>
                                <td class="text-end">Rp{{ number_format($item->variant->harga ?? 0) }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" name="qty" value="{{ $item->qty }}" min="1" class="form-control form-control-sm" style="max-width: 80px;">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-end">Rp{{ number_format(($item->variant->harga ?? 0) * $item->qty) }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('cart.delete', $item->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                     <tfoot>
                        <tr class="table-primary">
                            <th colspan="4" class="text-end">Total Belanja:</th>
                            <th class="text-end">
                                Rp{{ number_format($carts->sum(fn($item) => ($item->variant->harga ?? 0) * $item->qty)) }}
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="/" class="btn btn-success btn-lg">
                    Checkout
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
