let urutkan = document.getElementById("urutkan");
const appurl = document.querySelector("meta[name=_appurl]").content;
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
async function getDetailProdukBasedById(id){
    const data = await fetch(appurl + "/produk/detail/modal?id="+id);
    const response = await data.text();
    return response;
}
async function showDetailProduk(e){
    if(e.target.classList.contains("btn-modal")){
        const data = await getDetailProdukBasedById(e.target.dataset.id);
        modalBody.innerHTML = data;
    }
}
async function getProdukByKategoriId(kategoriId){
    try {
        const data = await fetch(appurl + "/produk/kategori?kategori=" + kategoriId);
        const response = await data.text();
        if(!data.ok){
            await showAlertDanger("HTTP ERROR" + data.status);
            throw new Error("HTTP ERROR " +data.status);
        }
        return response;
    } catch (error) {
        await showAlertDanger("Gagal fetch data " +error);
    }
}
async function deleteDataOrder(url, id) {

    const token = document.querySelector("meta[name=_token]").content;

    try {
        const dataToSend = {
            id: id
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

        if (!data.ok) {
            await showAlertDanger("HTTP ERROR " + data.status);
            throw new Error('HTTP ERROR', data.status);
        }
        if (data.status == 200) {
            await showAlertSuccess(response.message);
        }

    } catch (error) {
        await showAlertDanger("Gagal fetch data dari api " + error);
    }
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
async function showConfirmAlert(e) {
    if (e.target.classList.contains("hapus")) {
        await showQuestionAlert().then((result) => {
            if (result.isConfirmed) {
                const url = appurl + "/order/hapus";
                let id = e.target.dataset.id;
                deleteDataOrder(url, id);
                const parent = e.target.parentElement.parentElement.parentElement.parentElement
                parent.remove();
            }
        });
    }
}
async function showQuestionAlert(){
    return await Swal.fire({
            title: "Are you sure?",
            text: "Apa kamu yakin ingin menghapus pesanan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        });
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

if(listProduk != null)
    listProduk.addEventListener("click", showDetailProduk);

let data;
if(kategori != null){
    for(let i = 0; i < kategori.length; i++){
        kategori[i].addEventListener("click",async function(){
            switch(kategori[i].innerText){
                case "Makanan":
                    data = await getProdukByKategoriId(1);
                    listProduk.innerHTML = data;
                    break;
                case "Minuman":
                    data = await getProdukByKategoriId(2);
                    listProduk.innerHTML = data;
                    break;
                case "Souvenir":
                    data = await getProdukByKategoriId(3);
                    listProduk.innerHTML = data;
                    break;
                default:
                    data = await getProdukByKategoriId(null);
                    listProduk.innerHTML= data;
                    break;

            }
        });
    }
}