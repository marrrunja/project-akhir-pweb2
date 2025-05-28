let urutkan = document.getElementById("urutkan");
let konten = document.getElementById("konten");
let APIURL = "http://127.0.0.1:8000/api/orderListByTanggal";
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


