export async function showAlertSuccess(pesan) {
    return await Swal.fire({
        title: "Sukses",
        icon: "success",
        draggable: true,
        text: pesan,
    });
}
export async function showAlertDanger(pesan) {
    return await Swal.fire({
        title: "Gagal",
        icon: "error",
        draggable: true,
        text: pesan
    });
}

export async function showConfirm(text, icon, confirm)
{
    return await Swal.fire({
        title: 'Kamu yakin?',
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirm
    });
}