const APIURL = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/1571.json';
const kecamatan = document.getElementById("kecamatan");
const desa = document.getElementById("desa");

async function getDataKota(){
    const data = await fetch(APIURL);
    const json = await data.json();
    let sum = 0;
    json.map(async (item) => {
        let option = `<option value="${item.name}" data-id=${item.id}>${item.name}</option>`;
        kecamatan.innerHTML += option;
    });
}

async function getDataKecamatanById(){
    desa.innerHTML = `<option value="">Pilih Desa</option>`;
    let selectedOption = kecamatan.options[kecamatan.selectedIndex];
    let id = selectedOption.dataset.id;
    const APIDESA = 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/'+id+'.json'; 
    const data = await fetch(APIDESA);
    const json = await data.json();
    json.map((item) => {
        let option = `<option value="${item.id}">${item.name}</option>`;
        desa.innerHTML += option;
    });
}

kecamatan.addEventListener("change",getDataKecamatanById);
getDataKota();