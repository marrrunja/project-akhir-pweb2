const cartItem = document.getElementById("cart");
const appurl = document.querySelector("meta[name=_appurl]").content;
const urlHapusCart = appurl+"/cart/delete";
const urlUpdateCart = appurl+"/cart/update/{id}";
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
        e.stopPropagation();
    }
}

cartItem.addEventListener("click", removeItemCart);


document.addEventListener('DOMContentLoaded', async () => {
    await initCartHandler();
    updateCartSummary();

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

                const hargaText = button.closest('.cart-item').querySelector('.current-price').textContent.replace(/[^\d]/g, '');
                const harga = parseInt(hargaText);

                updateItemTotal(button, harga);
                updateCartSummary();
            }
            else {
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

function updateItemTotal(button, harga) {
    const qty = parseInt(button.parentElement.querySelector('.quantity-input').value);
    const totalEl = button.closest('.cart-item').querySelector('.item-total span');
    totalEl.textContent = "Rp" + new Intl.NumberFormat('id-ID').format(harga * qty);
}

function updateCartSummary() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const qty = parseInt(item.querySelector('.quantity-input').value);
        const priceText = item.querySelector('.current-price').textContent.replace(/[^\d]/g, '');
        const harga = parseInt(priceText);
        total += harga * qty;
    });

    const formatted = "Rp" + new Intl.NumberFormat('id-ID').format(total);
    document.querySelectorAll('.summary-value').forEach(el => {
        el.textContent = formatted;
    });
}



