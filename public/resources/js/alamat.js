const APIURL = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/1571.json';
const kecamatan = document.getElementById("kecamatan");
const desa = document.getElementById("desa");

async function getDataKota(){
    const data = await fetch(APIURL);
    const json = await data.json();
    json.map((item) => {
        let option = `<option value="${item.id}" data-id=${item.id}>${item.name}</option>`
        kecamatan.innerHTML += option;
    });
}

async function getDataKecamatanById(e){
    console.log(e.target);
    desa.innerHTML = `<option value="">Pilih Desa</option>`;
    const APIDESA = 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/'+kecamatan.value+'.json'; 
    const data = await fetch(APIDESA);
    const json = await data.json();
    json.map((item) => {
        let option = `<option value="${item.name}">${item.name}</option>`;
        desa.innerHTML += option;
    })
}
kecamatan.addEventListener("change",getDataKecamatanById);
getDataKota();