let urutkan = document.getElementById("urutkan");
const appurl = document.querySelector("meta[name=_appurl]").content;
let konten = document.getElementById("konten");
let APIURL = appurl+ "/api/orderListByTanggal";
console.log(appurl)
console.log(APIURL)
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


urutkan.addEventListener("change", orderByTanggal);


