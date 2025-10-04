let urutkan = document.getElementById("urutkan");
const appurl = document.querySelector("meta[name=_appurl]").content;
const token = document.querySelector("meta[name=_token]").content;
let konten = document.getElementById("konten");
let APIURL = appurl + "/api/orderListByTanggal";

let inputCari = document.getElementById("inputCari");
let btnCari = document.getElementById("btnCari");
let containerTableProduk = document.getElementById("content-produk");
const bodyTable = document.getElementById("body-table");
const content = document.getElementById("content");
const listProduk = document.getElementById("list-produk");
const modalBody = document.getElementById("modal-body");
let kategori = document.getElementsByClassName("kategori");

async function showQuestionAlert(pesan) {
    return await Swal.fire({
        title: "Are you sure?",
        text: pesan,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
    });
}

async function showAlertSuccess(pesan) {
    return await Swal.fire({
        title: "Sukses",
        icon: "success",
        draggable: true,
        text: pesan,
    });
}

async function showAlertDanger(pesan) {
    return await Swal.fire({
        title: "Gagal",
        icon: "error",
        draggable: true,
        text: pesan
    });
}


async function orderByTanggal() {
    try {
        let response = await fetch(APIURL + "?order=" + urutkan.value);
        let text = await response.text();
        if (response.status == 200) {
            konten.innerHTML = text;
        }
    } catch (err) {
        console.log("Error ", err);
    }
}
async function getDataSearchFromApi(keyword, element) {
    try {
        let response = await fetch(appurl + "/produk/search?keyword=" + keyword);
        let text = await response.text();

        if (!response.ok) {
            element.innerHTML = `Http error ${response.status}`;
            throw new Error(`Http error ${response.status}`);
        }
        if (response.status === 200) {
            element.innerHTML = text;
        }

    } catch (error) {
        console.log("Gagal fetch data " + error);
        element.innerHTML = "Gagal fetch data " + error;
    }
}

function onButtonSearchClick() {
    getDataSearchFromApi(inputCari.value, containerTableProduk);
}

function onKeyDownEnterInput(e) {
    if (e.key == "Enter") {
        getDataSearchFromApi(inputCari.value, containerTableProduk);
    }
}
async function getDetailProdukBasedById(id) {
    const data = await fetch(appurl + "/produk/detail/modal?id=" + id);
    const response = await data.text();
    return response;
}

async function showDetailProduk(e) {
    if (e.target.classList.contains("btn-modal")) {
        const data = await getDetailProdukBasedById(e.target.dataset.id);
        modalBody.innerHTML = data;
    }
}
async function getProdukByKategoriId(kategoriId) {
    try {
        const data = await fetch(appurl + "/produk/kategori?kategori=" + kategoriId);
        const response = await data.text();
        if (!data.ok) {
            throw new Error("HTTP ERROR " + data.status);
        }
        return response;
    } catch (error) {
        await showAlertDanger("Gagal fetch data " + error);
    }
}
async function deleteDataOrder(url, id, orderId) {

    const token = document.querySelector("meta[name=_token]").content;
    let isSuccess = false;
    try {
        const dataToSend = {
            id: id,
            orderId: orderId
        };
        const data = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "Application/json",
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify(dataToSend)
        });

        const response = await data.json();
        console.log(response);


        if (!data.ok) {
            throw new Error('HTTP ERROR', data.status);
        }
        if (data.status == 200) {
            await showAlertSuccess(response.message);
            isSuccess = true;
        }

    } catch (error) {
        await showAlertDanger(error);
    }
    return isSuccess;
}

async function deleteOrder(url, id){
    try {
        const dataToSend = {
            id: id,
        };
        let isSuccess = false;
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "Application/json",
                "X-CSRF-TOKEN": token
            },
            body: JSON.stringify(dataToSend)
        });
        const responseServer = await response.json();
        if(!response.ok){
            throw new Error("HTTP ERROR ", response.status);
        }
        if(response.status === 200){
            await showAlertSuccess(responseServer.message);
            console.log(responseServer);
            isSuccess = true;
        }else{
            await showAlertDanger(responseServer.message);
        }
    } catch (error) {
        await showAlertDanger("Gagal fetching data "+error);
    }
    return isSuccess;
}

async function showConfirmAlert(e) {
    if (e.target.classList.contains("hapus")) {
        await showQuestionAlert("Apa kamu yakin ingin membatalkan pesanan?").then((result) => {
            if (result.isConfirmed) {
                const url = appurl + "/api/order/hapus";
                let totalPesanan = document.getElementById("totalPesanan");
                let id = e.target.dataset.id;
                let orderId = e.target.dataset.order;
                deleteDataOrder(url, id, orderId);
                const parent = e.target.parentElement.parentElement.parentElement.parentElement
                parent.remove();
                let total = parseInt(totalPesanan.innerText);
                totalPesanan.textContent = total - 1;
            }
        });
    }

    if (e.target.classList.contains("hapusRiwayat")) {
        await showQuestionAlert("Kamu yakin ingin menghapus riwayat? sudah tidak bisa dikembalikan lagi").then((result) => {
            if (result.isConfirmed) {
                const url = appurl + "/api/riwayat/delete";
                let totalPesanan = document.getElementById("totalPesanan");
                let id = e.target.dataset.id;
                if (deleteOrder(url, id)) {
                    const parent = e.target.parentElement.parentElement.parentElement.parentElement
                    parent.remove();
                    let total = parseInt(totalPesanan.innerText);
                    totalPesanan.textContent = total - 1;
                }
            }
        });
    }
}

if (urutkan != null)
    urutkan.addEventListener("change", orderByTanggal);

if (btnCari != null) {
    btnCari.addEventListener("click", onButtonSearchClick);
}
if (inputCari != null)
    inputCari.addEventListener("keydown", onKeyDownEnterInput);

if (bodyTable != null)
    bodyTable.addEventListener("click", showConfirmAlert);

if (listProduk != null)
    listProduk.addEventListener("click", showDetailProduk);

let data = null;
if (kategori != null) {
    let judulKategori = document.getElementById("judul-kategori");
    for (let i = 0; i < kategori.length; i++) {
        kategori[i].addEventListener("click", async function () {
            switch (kategori[i].innerText) {
                case "Makanan":
                    data = await getProdukByKategoriId(1);
                    listProduk.innerHTML = data;
                    judulKategori.innerText = "Makanan";
                    break;
                case "Minuman":
                    data = await getProdukByKategoriId(2);
                    listProduk.innerHTML = data;
                    judulKategori.innerText = "Minuman";
                    break;
                case "Souvenir":
                    data = await getProdukByKategoriId(3);
                    judulKategori.innerText = "Souvenir";
                    listProduk.innerHTML = data;
                    break;
                default:
                    data = await getProdukByKategoriId(null);
                    listProduk.innerHTML = data;
                    judulKategori.innerText = "Produk";
                    break;
            }
        });
    }
}
