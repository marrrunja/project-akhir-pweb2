<div>
    @if(Session::has('apa'))
        <div>{{ Session::get('apa') }}</div>
    @endif
    <form method="post" action="http://127.0.0.1:8000/api/payment/index">
        <h1>Halaman form</h1>
        <p>
            <input type="text" name="nama" placeholder="Nama">
        </p>
        <p>
            <input type="email" name="email" placeholder="Email">
        </p>
        <p>
            <input type="number" name="harga" placeholder="Harga satuan">
        </p>
        <p>
            <input type="number" placeholder="Jumlah" name="jumlah">
        </p>
        <p>
            <input type="number" name="totalHarga" placeholder="Total harga">
        </p>
        <p>
            <button type="submit">Kirim</button>
        </p>

    </form>
</div>
