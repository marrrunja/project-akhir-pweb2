let urutkan = document.getElementById("urutkan");
const appurl = document.querySelector("meta[name=_appurl]").content;
let konten = document.getElementById("konten");
let APIURL = appurl+ "/api/orderListByTanggal";

let inputCari = document.getElementById("inputCari");
let btnCari = document.getElementById("btnCari");
console.log(appurl);
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
async function getDataPencarian()
{
	try{
		let response = await fetch(appurl+"/produk/search?keyword=" + inputCari.value);
		let json = await response.json();

		if(!response.ok){
			throw new Error(`Http error ${response.status}`);
		}
		console.log(json);
		console.log("Nothing");


	}catch(error){
		console.log("Gagal fetch data " + error);
	}
}

if(urutkan != null)
	urutkan.addEventListener("change", orderByTanggal);

if(btnCari != null){
	btnCari.addEventListener("click", getDataPencarian);
}
	


