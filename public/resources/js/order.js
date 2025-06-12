const token = document.querySelector('meta[name="_token"]').content;
const appurl = document.querySelector("meta[name=_appurl]").content;
const btnTambah = document.getElementsByClassName("btnTambah");
const btnKurang = document.getElementsByClassName("btnKurang");
const jumlah = parseInt(document.getElementById("jumlah").dataset.max);
const btnHasil = document.getElementsByClassName("btnHasil");
const pesan = document.getElementsByClassName("pesan");
const btnCart = document.getElementsByClassName("btnCart");
const cartItems = document.querySelector('.cart-items');
console.log(cartItems);

for (let i = 0; i < btnTambah.length; i++) {
    btnTambah[i].addEventListener("click", function () {
        let angka = parseInt(btnHasil[i].innerText);
        angka++;
        if (angka > parseInt(btnTambah[i].nextElementSibling.dataset.max)) {
            pesan[i].innerText = "Stok tersisa tidak cukup";
            pesan[i].classList.remove("d-none");
            setTimeout(function () {
                pesan[i].classList.add("d-none");
            }, 2000);
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
            pesan[i].innerText = "Jumlah tidak boleh kurang dari 1!!";
            pesan[i].classList.remove("d-none");
            setTimeout(function () {
                pesan[i].classList.add("d-none");
            }, 2000);
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
            pesan[i].innerText = "Jumlah tidak boleh kurang dari 1!!";
            pesan[i].classList.remove("d-none");
            setTimeout(function () {
                pesan[i].classList.add("d-none");
            }, 2000);
            return;
        };
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
                pesan[i].innerText = "Error " + response.status;
                pesan[i].classList.remove("d-none");
                setTimeout(function () {
                    pesan[i].classList.add("d-none");
                }, 2000);
                throw new Error("HTTP ERROR " + response.status);
            }
            if (response.status == 200) {
                let responseServer = await response.json();
                pesan[i].innerText = responseServer.message;
                pesan[i].classList.remove("d-none");
                pesan[i].classList.remove("text-danger");
                pesan[i].classList.add("text-success");
                setTimeout(function () {
                    pesan[i].classList.add("d-none");
                    pesan[i].classList.remove("text-success");
                }, 2000);
            }
        } catch (error) {
            console.error(error);
            pesan[i].innerText = "Error " + error;
            pesan[i].classList.remove("d-none");
            setTimeout(function () {
                pesan[i].classList.add("d-none");
            }, 2000);
        }
    });
}
