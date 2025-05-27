const rowKonten = document.getElementById("rowKonten");
let token = document.querySelector("meta[name=_token]").content;

let apiurl = 'http://127.0.0.1:8000/admin/produk/variants/edit';
let sibling = null;
let formUbah = document.getElementById("formUbah");

function insertAfter(newNode, existingNode) {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}


function createInputEditElement(variant, jumlah, harga, token, id) {
    let tr = document.createElement("tr");

    let inputNama = `<input type="text" name="variant" value="${variant}" class="form-control">`;
    let inputHarga = `<input value="${harga}" name="harga" class="form-control">`;
    let inputJumlah = `<input type="number" name="jumlah" value="${jumlah}" class="form-control">`;
    let inputTokenCsrf = `<input type="hidden" name="_token" value="${token}">`;
    let inputIdHidden = `<input type="hidden" name="id" value="${id}">`;

    let tdVariant = document.createElement('td');
    let tdHarga = document.createElement('td');
    let tdJumlah = document.createElement('td');

    tdVariant.setAttribute("colspan", "3");

    tdVariant.innerHTML = inputNama + inputTokenCsrf;
    tdVariant.innerHTML += inputIdHidden;
    tdHarga.innerHTML = inputHarga;
    tdJumlah.innerHTML = inputJumlah;

    tr.append(tdVariant);
    tr.append(tdHarga);
    tr.append(tdJumlah);

    return tr;
}
async function getDataFromApi(id) {
    try {
        let response = await fetch(apiurl + '?id=' + id);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        if (response.status == 200) {
            let json = await response.json();
            let data = json.variant[0];
            return data;
        }
    } catch (error) {
        console.log("Error get data from api!!", error);
    }
}
async function showInputEditElement(target) {
    let btnEdit = target;
    let parentElement = btnEdit.parentElement.parentElement;
    let data = await getDataFromApi(btnEdit.dataset.id);

    let tr = createInputEditElement(data.variant, data.jumlah, data.harga, token, data.id);
    insertAfter(tr, parentElement);

    let button = `
        <button class="btn btn-primary btnUbah" type="submit">Ubah</button>
        <button type="button" class="btn btn-warning batal">Batal</button>`;

    sibling = 1;
    let tdButton = document.createElement('td');
    tdButton.innerHTML = button;
    tr.append(tdButton);
}

async function showDetailVariant(e) {
    if (e.target.classList.contains("btnEdit")) {
        if (sibling != null) return;
        showInputEditElement(e.target);
    }
    if (e.target.classList.contains('batal')) {
        e.target.parentElement.parentElement.remove();
        sibling = null;
    }
    if (e.target.classList.contains("btnUbah")) {
        formUbah.setAttribute("action", "http://127.0.0.1:8000/admin/produk/variants/doEdit");
    }
}


rowKonten.addEventListener("click", showDetailVariant);
