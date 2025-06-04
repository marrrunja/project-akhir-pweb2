const token = document.querySelector('meta[name="_token"]').content;
const appurl = document.querySelector("meta[name=_appurl]").content;
const jumlah = document.getElementById("jumlah").innerText;
const totalHarga = document.getElementById("hargaTotal").innerText;
const URLENDPOINT = appurl+"/transaksi/checkout";
const REDIRECTURL = appurl;
const btnBayar = document.getElementById("btnBayar");
let hargaSatuan = document.getElementById("hargaSatuan").innerText;

const array = Array.from(totalHarga);
const total = parseInt(array.filter((item) => item != '.')
                                .reduce((str, item) => str += item));
hargaSatuan = parseInt(Array.from(hargaSatuan).filter((item) => item != '.').reduce((str, item) => str += item));
async function sendData()
{
    const data = {
        jumlah : jumlah,
        totalHarga : total,
        id:btnBayar.dataset.id,
        harga:hargaSatuan
    }
    console.log(data);
    try{
        const response = await fetch(URLENDPOINT, {
            method:'POST',
            headers: {
                'Content-Type': 'Application/json',
                'X-CSRF-TOKEN':token
            },
            body:JSON.stringify(data)
        });

        if(!response.ok){
            throw new Error("HTTP ERROR " + response.status);
        }

        const responseServer = await response.json();
        console.log(responseServer);
        if(response.status === 200 && responseServer.status === 'berhasil'){
            document.location.href = responseServer.redirect_url;
        }
        else{
            document.location.href = REDIRECTURL +"/transaksi/checkout/fail?pesan="+responseServer.pesan;
        }
    }catch(error){
        console.error("Error fetching data "+error)
    }
}

btnBayar.addEventListener("click", sendData);