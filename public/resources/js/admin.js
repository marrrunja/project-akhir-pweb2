const rowKonten = document.getElementById("rowKonten");
let token = document.querySelector("meta[name=_token]").content;
let appurl = document.querySelector("meta[name=_appurl]").content;
let apiurl = appurl+'/api/produk/variants/edit';
let sibling = null;
let contentAddVariant = false;
let formUbah = document.getElementById("formUbah");
let btnTambahProdukVariant = document.getElementById("btnTambahProdukVariant");
let formTambahProdukVariant = document.getElementById("form-tambah");

function insertAfter(newNode, existingNode) {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}


function createInputEditElement(variant, jumlah, harga,foto, token, id) {
    let tr = document.createElement("tr");

    let inputNama = `<input type="text" name="variant" value="${variant}" class="form-control">`;
    let inputFotoHidden = `<input type="hidden" name="foto" value="${foto}">`
    let inputHarga = `<input value="${harga}" name="harga" class="form-control">`;
    let inputJumlah = `<input type="number" name="jumlah" value="${jumlah}" class="form-control">`;
    let inputTokenCsrf = `<input type="hidden" name="_token" value="${token}">`;
    let inputIdHidden = `<input type="hidden" name="id" value="${id}">`;
    let inputFoto = '<input type="file" name="gambar" class="form-control">';

    let tdVariant = document.createElement('td');
    let tdHarga = document.createElement('td');
    let tdJumlah = document.createElement('td');
    let tdFile = document.createElement("td");

    tdVariant.setAttribute("colspan", "2");

    tdVariant.innerHTML = inputNama + inputTokenCsrf + inputFotoHidden;
    tdVariant.innerHTML += inputIdHidden;
    tdHarga.innerHTML = inputHarga;
    tdJumlah.innerHTML = inputJumlah;
    tdFile.innerHTML = inputFoto;

    tr.append(tdVariant);
    tr.append(tdHarga);
    tr.append(tdJumlah);
    tr.append(tdFile);

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

    let tr = createInputEditElement(data.variant, data.jumlah, data.harga, data.foto,token, data.id);

    insertAfter(tr, parentElement);

    let button = `
        <button class="btn btn-primary btnUbah" type="submit">Ubah</button>
        <button type="button" class="btn btn-warning batal">Batal</button>`;

    sibling = 1;
    let tdButton = document.createElement('td');
    tdButton.classList.add("d-flex");
    tdButton.classList.add("gap-2");
    tdButton.innerHTML = button;
    tr.append(tdButton);
}

async function showDetailVariant(e) {
    if (e.target.classList.contains("btnEdit")) {
        if (sibling != null) return;
        showInputEditElement(e.target);
        sibling = 1;
        e.stopPropagation();
    }
    if (e.target.classList.contains('batal')) {
        e.target.parentElement.parentElement.remove();
        sibling = null;
        e.stopPropagation();
    }
    if (e.target.classList.contains("btnUbah")) {
        formUbah.setAttribute("action", appurl+"/admin/produk/variants/doEdit");
        formUbah.setAttribute("enctype", "multipart/form-data");
        e.stopPropagation();
    }
}
function makeInputAddVariantElement()
{
    let containerAddProdukVariant = document.createElement("div");
    let containerBtn = document.createElement("div");
    containerAddProdukVariant.classList.add("d-flex");
    containerAddProdukVariant.classList.add("flex-wrap");
    containerAddProdukVariant.classList.add("gap-3");

    let inputToken = `<input type="hidden" name="_token" value="${token}">`;
    let inputVarian = `<input type="text" name="nama" placeholder="Nama variant" class="form-control" required>`;
    let inputHarga = `<input type="number" name="harga" placeholder="Harga Produk Variant" class="form-control" required>`;
    let inputStok = `<input type="number" name="stok" placeholder="Stok Produk Variant" class="form-control" required>`;
    let inputGambar = `<input type="file" name="gambar" class="form-control" required>`;

    let btnSubmit = `<button type="submit" class="btn btn-success mb-3 mt-2 me-2">Tambah</button>`;
    let btnBatal = `<button type="button" class="btn btn-danger btn-batal mb-3 mt-2">Batal</button>`;
    
    containerAddProdukVariant.innerHTML = inputToken + inputVarian + inputHarga + inputStok + inputGambar;
    containerBtn.innerHTML = btnSubmit + btnBatal;
    formTambahProdukVariant.append(containerAddProdukVariant);
    formTambahProdukVariant.append(containerBtn);
    contentAddVariant = true;

    const btn = document.querySelector('.btn-batal');
    btn.addEventListener("click", function(){
        btn.parentElement.previousElementSibling.remove();
        btn.parentElement.remove();
        contentAddVariant = false;
    });
}

function addProdukVariant(e)
{
    if(contentAddVariant == true) return;
    let apiData = appurl+"/produk/variant/tambah/"+this.dataset.id;
    makeInputAddVariantElement();
    formTambahProdukVariant.setAttribute("action", apiData);
}

rowKonten.addEventListener("click", showDetailVariant);
btnTambahProdukVariant.addEventListener("click", addProdukVariant);



