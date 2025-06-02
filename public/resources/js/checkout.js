const token = document.querySelector('meta[name="_token"]').content;
const appurl = document.querySelector("meta[name=_appurl]").content;
const jumlah = document.getElementById("jumlah").innerText;
const totalHarga = document.getElementById("hargaTotal").innerText;
const URLENDPOINT = appurl+"/transaksi/checkout";
const REDIRECTURL = appurl;
const btnBayar = document.getElementById("btnBayar");
const hargaSatuan = document.getElementById("hargaSatuan").innerText;

const array = Array.from(totalHarga);
const total = parseInt(array.filter((item) => item != '.')
                                .reduce((str, item) => str += item));

async function sendData()
{
    const data = {
        jumlah : [jumlah],
        totalHarga : total,
        id:[btnBayar.dataset.id],
        harga:hargaSatuan
    }
    try{
        const response = await fetch(URLENDPOINT, {
            method:'POST',
            headers: {
                'Content-Type': 'Application/json',
                'X-CSRF-TOKEN':token
            },
            body:JSON.stringify(data)
        });

        const responseServer = await response.json();
        if(response.status === 200 && responseServer.status === 'berhasil')
            document.location.href = REDIRECTURL +"/transaksi/checkout/success";
        else
            document.location.href = REDIRECTURL +"/transaksi/checkout/fail?pesan="+responseServer.pesan;
    }catch(error){
        console.error("Error fetching data "+error)
    }
}

btnBayar.addEventListener("click", sendData);