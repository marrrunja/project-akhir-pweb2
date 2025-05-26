const btnTambah = document.getElementById("tambahVariant");
const btnKurang = document.getElementById("kurangiVariant");
const container = document.getElementById("gaada");
const jumlahVariant = document.getElementById("jumlahVariant");
const pesan = document.getElementById("pesan");
let i = 1;

function hilangkanElementPesan()
{
	pesan.lastElementChild.remove();
}
function scrollByLines(lines = 1) {
    const lineHeight = parseInt(getComputedStyle(document.body).lineHeight, 10) || 20;
    window.scrollBy({
        top: lineHeight * lines,
        behavior: 'smooth'
    });
}


function tambahInputVariant()
{
	if(i > 5){
		pesan.innerHTML = `<div class="fw-semibold text-danger">Variant terlalu banyak!</div`;
		setTimeout(hilangkanElementPesan,1500);
		return;
	}
	i++;
	jumlahVariant.value = i;
	let inputVariant = `
                        <fieldset class="shadow p-3 rounded">
                            <legend>Varian ${i}</legend>
							<div class="mb-3">
                                <label for="variant${i}" class="form-label">Nama varian</label>
                                <input type="text" id="variant${i}" name="variant[]" class="form-control"placeholder="Contoh, original" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga${i}" class="form-label">Harga</label>
                                <input type="number" name="harga[]" class="form-control" id="harga${i}" placeholder="Contoh, 5000" required>
                            </div>
                            <div class="mb-3">
                                 <label for="stok${i}" class="form-label">Stok</label>
                                <input type="number" id="stok${i}" name="stok[]" class="form-control" id="stok" placeholder="Contoh, 10" required>
                            </div>
                        </fieldset>
                   `;
    let div = document.createElement("div");
    div.classList.add("mb-3");
    div.innerHTML = inputVariant;
	container.append(div);
	scrollByLines(1000);
}
function kurangiVariant()
{
	if(i === 1) return;
	i--;
	jumlahVariant.value = i;
	container.lastElementChild.remove();
}
btnTambah.addEventListener("click", tambahInputVariant);
btnKurang.addEventListener("click", kurangiVariant);
