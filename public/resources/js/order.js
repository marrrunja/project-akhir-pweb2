import { showAlertDanger } from "./utility/alert.js";

const token = document.querySelector('meta[name="_token"]').content;
const appurl = document.querySelector("meta[name=_appurl]").content;
const btnTambah = document.getElementsByClassName("btnTambah");
const btnKurang = document.getElementsByClassName("btnKurang");
const jumlah = parseInt(document.getElementById("jumlah").dataset.max);
const btnHasil = document.getElementsByClassName("btnHasil");
const pesan = document.getElementsByClassName("pesan");
const btnCart = document.getElementsByClassName("btnCart");
const cartItems = document.querySelector('.cart-items');


function showTextError(i, message){
    pesan[i].innerText = message;
    pesan[i].classList.remove("d-none");
    setTimeout(function () {
        pesan[i].classList.add("d-none");
    }, 2000);
}

function showTextSuccess(i, message){
    pesan[i].innerText = message;
    pesan[i].classList.remove("d-none");
    pesan[i].classList.remove("text-danger");
    pesan[i].classList.add("text-success");
    setTimeout(function () {
        pesan[i].classList.add("d-none");
        pesan[i].classList.remove("text-success");
    }, 2000);
}
async function getTotalQuantityFromCart(id)
{
    try{
        const response = await fetch('/cart/get-stok?id='+id);
        const data = await response.json();

        if(!response.ok){
            throw new Error("HTTP ERROR", response.status);
        }
        if(response.status === 200)
            return [data.stok, data.jumlah];

    }catch(error){
        await showAlertDanger(error);
    }
    
}

for (let i = 0; i < btnTambah.length; i++) {
    btnTambah[i].addEventListener("click", function () {
        let angka = parseInt(btnHasil[i].innerText);
        angka++;
        if (angka > parseInt(btnTambah[i].previousElementSibling.previousElementSibling.dataset.max)) {
            showTextError(i, "Stok tersisa tidak cukup");
            return;
        }
        btnHasil[i].innerText = angka;
        btnHasil[i].previousElementSibling.value = angka;
    });
}
for (let i = 0; i < btnKurang.length; i++) {
    btnKurang[i].addEventListener("click", function () {
        let angka = parseInt(btnHasil[i].innerText);
        angka--;
        if (angka < 1) {
            showTextError(i, "Jumlah tidak boleh kurang dari 1");
            return;
        };
        btnHasil[i].innerText = angka;
        btnHasil[i].previousElementSibling.value = angka;
    });
}

for (let i = 0; i < btnCart.length; i++) {
    btnCart[i].addEventListener("click", async function () {
        let qty = parseInt(btnHasil[i].innerText);
        if (qty < 1) {
            showTextError(i, "Jumlah tidak boleh kurang dari 1");
            return;
        };
        let [qtyCart,stokTersisa ] = await getTotalQuantityFromCart(btnCart[i].dataset.id);

        if(qty + qtyCart > stokTersisa){
            await showAlertDanger("Anda sudah mencapai sisa stok untuk produk ini di cart anda!!");
            return;
        }
        try {
            let data = {
                variant_id: btnCart[i].dataset.id,
                qty: qty
            };
            let response = await fetch(appurl + "/cart/store", {
                method: "POST",
                headers: {
                    "content-type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify(data)
            });
            if (!response.ok) {
                throw new Error("HTTP ERROR " + response.status);
            }
            if (response.status == 200) {
                let responseServer = await response.json();
                showTextSuccess(i, responseServer.message);
                setTimeout(() => {
                    document.location.reload(false);
                }, 1500);
            }
        } catch (error) {
            console.error(error);
            showTextError(i, "Error " + error);
        }
    });
}
