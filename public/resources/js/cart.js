const cartItem = document.getElementById("cart");
const urlHapusCart = "http://127.0.0.1:8000/cart/delete";
const urlUpdateCart = "http://127.0.0.1:8000/cart/update/{id}"
let token = document.querySelector("meta[name=_token]").content;

async function removeItemCart(e) {
    if (e.target.classList.contains("hilangkan-item")) {
        const parent = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
        const cartId = e.target.dataset.id;
        const userId = e.target.dataset.user;

        const data = {
            id: cartId,
            userId: userId
        };

        // Konfirmasi dulu sebelum hapus
        Swal.fire({
            title: 'Kamu yakin?',
            text: "Item ini akan dihapus dari keranjang.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus aja!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(urlHapusCart, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": token
                        },
                        body: JSON.stringify(data)
                    });

                    if (response.ok) {
                        const json = await response.json();
                        console.log(json);
                        parent.remove();

                        Swal.fire(
                            'Berhasil!',
                            'Item berhasil dihapus dari cart.',
                            'success'
                        );
                    } else {
                        const error = await response.json();
                        console.error(error);
                        Swal.fire(
                            'Oops!',
                            'Gagal menghapus item. Coba lagi nanti.',
                            'error'
                        );
                    }
                } catch (err) {
                    console.error("Fetch error:", err);
                    Swal.fire(
                        'Error!',
                        'Ada masalah jaringan atau server.',
                        'error'
                    );
                }
            }
        });
    }
}

cartItem.addEventListener("click", removeItemCart);


document.addEventListener('DOMContentLoaded', async () => {
    await initCartHandler();
});

async function initCartHandler() {
    const buttons = document.querySelectorAll('.quantity-btn');
    const updateQty = async (cartId, newQty, button) => {
        try {
            const url = urlUpdateCart.replace('{id}', cartId);
            const res = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ qty: newQty, id: cartId})
            });
            const data = await res.json();
            console.log(data);
            if (data.success) {
                const input = button.parentElement.querySelector('.quantity-input');
                input.value = data.qty;
            } else {
                Swal.fire('Gagal!', 'Gagal mengubah kuantitas. Coba lagi ya!', 'warning');
            }
        } catch (err) {
            console.error(err);
            Swal.fire('Error!', 'Terjadi kesalahan saat update kuantitas.', 'error');
        }
    };

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const isIncrease = btn.classList.contains('increase');
            const input = btn.parentElement.querySelector('.quantity-input');
            const cartId = btn.getAttribute('data-id');
            console.log(cartId);
            const stock = parseInt(btn.getAttribute('data-stock'));
            let currentQty = parseInt(input.value);

            let newQty = isIncrease ? currentQty + 1 : currentQty - 1;

            if (newQty < 1 || newQty > stock) {
                Swal.fire('Ups!', 'Jumlah tidak valid. Cek stok atau minimal pembelian.', 'warning');
                return;
            }

            updateQty(cartId, newQty, btn);
        });
    });
}
