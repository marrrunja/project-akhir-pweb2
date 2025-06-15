const APIURL = 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/1571.json';
const kecamatan = document.getElementById("kecamatan");
const desa = document.getElementById("desa");


async function getDataKecamatanById(){
    desa.innerHTML = `<option value="">Pilih Desa</option>`;
    const APIDESA = 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/'+kecamatan.value+'.json'; 
    console.log(APIDESA);
    const data = await fetch(APIDESA);
    const json = await data.json();
    json.map((item) => {
        let option = `<option value="${item.id}">${item.name}</option>`;
        desa.innerHTML += option;
    });
}
kecamatan.addEventListener("change", getDataKecamatanById);