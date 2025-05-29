const cartItem = document.getElementById("cart");
const urlHapusCart = "http://127.0.0.1:8000/cart/delete";
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function removeItemCart(e) {
    if (e.target.classList.contains("hilangkan-item")) {
        const parent = e.target.closest(".item-cart");
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
                        method: "DELETE",
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
