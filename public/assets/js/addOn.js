function confirmDelete(cutiId) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?","Blanko tetap tersimpan di server")) {
        // If the user clicks "OK" in the confirmation dialog, redirect to the delete URL
        window.location.href = "/hapus-pengajuan/" + cutiId;
    }
    // If the user clicks "Cancel," do nothing
}

function confirmDeletePersonal(cutiIdP) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?","Blanko tetap tersimpan di server")) {
        // If the user clicks "OK" in the confirmation dialog, redirect to the delete URL
        window.location.href = "/hapus-pengajuan-personal/" + cutiIdP;
    }
    // If the user clicks "Cancel," do nothing
}

function pegawaiDelete(pid) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        // If the user clicks "OK" in the confirmation dialog, redirect to the delete URL
        window.location.href = "/hapus-pegawai/" + pid;
    }
    // If the user clicks "Cancel," do nothing
}

function userDelete(uid) {
    if (confirm("Apakah Anda yakin ingin menghapus user ini?")) {
        // If the user clicks "OK" in the confirmation dialog, redirect to the delete URL
        window.location.href = "/hapus-user/" + uid;
    }
    // If the user clicks "Cancel," do nothing
}