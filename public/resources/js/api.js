let urutkan = document.getElementById("urutkan");
const appurl = document.querySelector("meta[name=_appurl]").content;
let konten = document.getElementById("konten");
let APIURL = appurl+ "/api/orderListByTanggal";

let inputCari = document.getElementById("inputCari");
let btnCari = document.getElementById("btnCari");
let containerTableProduk = document.getElementById("content-produk");
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
async function getDataSearchFromApi(keyword, element)
{
	try{
		let response = await fetch(appurl+"/produk/search?keyword=" + keyword);
		let text = await response.text();

		if(!response.ok){
			throw new Error(`Http error ${response.status}`);
			element.innerHTML = `Http error ${response.status}`;
		}
		if(response.status === 200){
			element.innerHTML = text;
		}

	}catch(error){
		console.log("Gagal fetch data " + error);
	}
}

async function onButtonSearchClick()
{
	getDataSearchFromApi(inputCari.value, containerTableProduk);
	
}

async function onKeyDownEnterInput(e)
{
	if(e.key=="Enter"){
		getDataSearchFromApi(inputCari.value, containerTableProduk);
	}
}

if(urutkan != null)
	urutkan.addEventListener("change", orderByTanggal);

if(btnCari != null){
	btnCari.addEventListener("click", onButtonSearchClick);
}
if(inputCari !=null)
	inputCari.addEventListener("keydown", onKeyDownEnterInput);


