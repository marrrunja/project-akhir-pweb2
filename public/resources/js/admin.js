const rowKonten = document.getElementById("rowKonten");
let token = document.querySelector("meta[name=_token]").content;

let apiurl = 'http://127.0.0.1:8000/admin/produk/variants/edit';
let sibling = null;

function insertAfter(newNode, existingNode) {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}
async function showDetailVariant(e)
{
    if(e.target.classList.contains("btnEdit")){
        let btnEdit = e.target;
        let parentElement = btnEdit.parentElement.parentElement;
        let tr = document.createElement("tr");
        let response = await fetch(apiurl+'?id='+btnEdit.dataset.id);
        let json = await response.json();
        let data = json.variant[0];
        if(response.status == 200){
            if(sibling != null) return;
            let inputNama = `<input type="text" name="nama" value="${data.variant}" class="form-control">`;
            let inputHarga = `<input value="${data.harga}" class="form-control">`;

            let nama = inputNama;
            let inputJumlah = `<input type="number" name="jumlah" value="${data.jumlah}" class="form-control">`;
            
            let tdVariant = document.createElement('td');
            let tdHarga = document.createElement('td');
            let tdJumlah = document.createElement('td');
            let tdButton = document.createElement('td');
            tdVariant.setAttribute("colspan", "3");
            tdVariant.innerHTML = inputNama;
            tdHarga.innerHTML = inputHarga;
            tdJumlah.innerHTML = inputJumlah;
            
            
            tr.append(tdVariant);
            tr.append(tdHarga);
            tr.append(tdJumlah);
            insertAfter(tr, parentElement);
            let button = `
            <button class="btn btn-primary btnUbah" type="button" data-id="${data.id}" data-harga="${tdHarga.firstElementChild.value}" data-jumlah="${tdJumlah.firstElementChild.value}" data-variant="${tdVariant.firstElementChild.value}">Ubah</button>
            <button type="button" class="btn btn-warning batal">Batal</button>`;
            sibling = 1;
            tdButton.innerHTML = button;
            tr.append(tdButton);
            console.log(tdJumlah.firstElementChild.value);
        }
    }
    if(e.target.classList.contains('batal')){
        e.target.parentElement.parentElement.remove();
        sibling = null;
    }
    if(e.target.classList.contains("btnUbah")){
        let harga = e.target.dataset.harga;
        let variant = e.target.dataset.variant;
        let jumlah = e.target.dataset.jumlah;
        let id = e.target.dataset.id;
        
        data = {
            id:id,
            harga:harga,
            jumlah:jumlah,
            variant:variant
        };
        
        let response = await fetch('http://127.0.0.1:8000/admin/produk/variants/doEdit',{
            method:'POST',
            headers: {
                'Content-Type': 'Application/json',
                'X-CSRF-TOKEN':token
            },
            body:JSON.stringify(data)
        });
        let json = await response.json();
        console.log(json)
    }
}


rowKonten.addEventListener("click", showDetailVariant);