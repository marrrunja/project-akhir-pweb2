const token = document.querySelector('meta[name="_token"]').content;
const btnTambah = document.getElementsByClassName("btnTambah");
const btnKurang = document.getElementsByClassName("btnKurang");
const jumlah = parseInt(document.getElementById("jumlah").dataset.max);
const btnHasil = document.getElementsByClassName("btnHasil");
const pesan = document.getElementsByClassName("pesan");

for(let i = 0; i < btnTambah.length; i++){
    btnTambah[i].addEventListener("click", function(){
        let angka = parseInt(btnHasil[i].innerText);
        angka++;
        if(angka > parseInt(btnTambah[i].nextElementSibling.dataset.max)) {
            pesan[i].innerText = "Stok tersisa tidak cukup";
          
            pesan[i].classList.remove("d-none");

            setTimeout(function(){
                pesan[i].classList.add("d-none");
            },2000);
            return;
        }
        btnHasil[i].innerText = angka;
        btnHasil[i].previousElementSibling.value = angka;
    });
}
for(let i = 0; i < btnKurang.length; i++){
    btnKurang[i].addEventListener("click", function(){
        let angka = parseInt(btnHasil[i].innerText);
        angka--;
        if(angka < 1) {
            pesan[i].innerText = "Jumlah tidak boleh kurang dari 1!!";
            pesan[i].classList.remove("d-none");
            setTimeout(function(){
                pesan[i].classList.add("d-none");
            },2000);
            return;
        };
      
        btnHasil[i].innerText = angka;
        btnHasil[i].previousElementSibling.value = angka;
    });
}

