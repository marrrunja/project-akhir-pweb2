import { showAlertSuccess } from "./utility/alert.js";
import { showAlertDanger } from "./utility/alert.js";
import { showConfirm } from "./utility/alert.js";

const cartItem = document.getElementById("cart");
const appurl = document.querySelector("meta[name=_appurl]").content;
const urlHapusCart = appurl + "/cart/delete";
const urlUpdateCart = appurl + "/cart/update/{id}";
let token = document.querySelector("meta[name=_token]").content;
let btnCheckout = document.getElementById("btnCheckout");
let btnCheckoutHeader = document.getElementById("btnCheckoutHeader");
let btnLogout = document.getElementById("btnLogout");
let formLogout = document.getElementById("form-logout");


let summaryValue = document.getElementById("summary-value");
let totalHarga = parseInt(Array.from(summaryValue.innerText)
                      .filter((item) => item != "R" && item != "p" && item != ",")
                      .reduce((str, item) => str += item));

                    

function getCartTotalHarga() {
    let total = 0;
    // document.querySelectorAll('.cart-ireng').forEach(item => {
    //     const qty = parseInt(item.querySelector('.quantity-input').value);
    //     const priceText = item.querySelector('.current-price').textContent.replace(/[^\d]/g, '');
    //     const harga = parseInt(priceText);
    //     total += harga * qty;
    // });
    return totalHarga;
}


async function showConfirmDeleteCart(){
    return await Swal.fire({
        title: 'Hapus semua?',
        text: 'Seluruh isi keranjang akan terhapus. Yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus semua!'
    });
}


async function removeItemCart(e) {
    if (e.target.classList.contains("remove-item")) {
        const itemElement = e.target.closest('.cart-item'); 
        const cartId = e.target.dataset.id;
        const userId = e.target.dataset.user;

        const data = {
            id: cartId,
            userId: userId
        };

        // Konfirmasi dulu sebelum hapus
        await showConfirm("Item ini akan dihapus dari cart", "warning", "Ya hapus aja").then(async (result) => {
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
                        if (!itemElement) return;
                        itemElement.remove();
                        updateCartSummary();

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

document.addEventListener("click", removeItemCart);


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
                body: JSON.stringify({ qty: newQty, id: cartId })
            });
            const data = await res.json();
            console.log(data);
            if (data.success) {

                const input = button.parentElement.querySelector('.quantity-input');

                input.value = data.qty;

                const hargaText = button.closest('.cart-ireng').querySelector('.current-price').textContent.replace(/[^\d]/g, '');
                const harga = parseInt(hargaText);

                console.log(data);
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
    const input = button.parentElement.querySelector('.quantity-input');
    const qty = parseInt(input.value);
    const totalEl = button.closest('.cart-ireng').querySelector('.item-total span');
    totalEl.textContent = "Rp" + new Intl.NumberFormat('id-ID').format(harga * qty);
}

function updateCartSummary() {
    let total = 0;
    document.querySelectorAll('.cart-ireng').forEach(item => {
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
const clearCart = document.getElementById("clear-cart-btn");
if(clearCart != null){
    clearCart.addEventListener('click',async function () {
        const userId = this.dataset.user;
       await showConfirmDeleteCart().then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch('/cart/clear', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ userId: userId })
                    });
    
                    const data = await response.json();
                    if (data.success) {
                        document.querySelectorAll('.cart-ireng').forEach(item => item.remove());
    
                        document.querySelectorAll('.summary-value').forEach(el => {
                            el.textContent = 'Rp0';
                        });
                        Swal.fire('Berhasil!', 'Semua item telah dihapus dari cart.', 'success');
                    } else {
                        Swal.fire('Oops!', 'Gagal menghapus isi cart.', 'error');
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                }
            }
        });
    });
}
// males rapihin, rapihin dewek


async function initOrders(id)
{
    let data = {
        userId: id,
        totalHarga: getCartTotalHarga()
    };
    try {
        let response = await fetch(appurl + "/transaksi/checkout/cart", {
            method:"POST",
            headers:{
                "content-type":"application/json",
                "X-CSRF-TOKEN":token
            },
            body:JSON.stringify(data)
        });
        let responseServer = await response.json();
        console.log(data)
        if(!response.ok){
            // await showAlertDanger("HTTP ERROR " + response.status);
            throw new Error("HTTP ERROR " + response.status);
        }
        if(response.status === 200){
            await showAlertSuccess(responseServer.message);
            setTimeout(function(){
                document.location.href = responseServer.redirect_url;
            },3000);
        }
    } catch (error) {
        await showAlertDanger(error);
        console.log(error);
    }
    
}


async function wantMakeOrders(e)
{
    e.preventDefault();
        if (getCartTotalHarga() <= 0) {
        await showAlertDanger("Keranjang masih kosong!!");
        return;
    }

    await showConfirm("Anda yakin ingin order sekarang", "question", "Iya").then(async (result) => {
        if(result.isConfirmed){
            initOrders(btnCheckout.dataset.id);
        }
    });
}
async function makeOrderCartHeader(e)
{
    e.preventDefault();
        if (getCartTotalHarga() <= 0) {
        await showAlertDanger("Keranjang masih kosong!!");
        return;
    }

    await showConfirm("Anda yakin ingin order sekarang", "question", "Iya").then(async (result) => {
        if(result.isConfirmed){
            initOrders(btnCheckoutHeader.dataset.id);
        }
    });
}

async function handleSubmit(event)
{
   event.preventDefault();
   await showConfirm("Anda yakin ingin logout?", "question", "Iya").then(async (result) => {
        if(result.isConfirmed){
            formLogout.submit();
        }
    });
}

if(btnCheckout != null){
    btnCheckout.addEventListener("click", wantMakeOrders);
}
if(btnCheckoutHeader != null){
    btnCheckoutHeader.addEventListener("click", makeOrderCartHeader);
}

btnLogout.addEventListener("click", handleSubmit);

