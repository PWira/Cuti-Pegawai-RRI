function confirmDelete(cutiId) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        // If the user clicks "OK" in the confirmation dialog, redirect to the delete URL
        window.location.href = "hapus-pengajuan/" + cutiId;
    }
    // If the user clicks "Cancel," do nothing
}

function uploadBlanko(event, blankoID) {
    event.preventDefault(); // Mencegah perilaku default tautan

    // Buat elemen input file
    var fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.id = 'respon_blanko';
    fileInput.name = 'respon_blanko';
    fileInput.accept = 'application/pdf';
    fileInput.required = true;

    // Tambahkan input file ke DOM
    event.target.parentNode.appendChild(fileInput);

    // Klik input file untuk membuka dialog pemilihan file
    fileInput.click();
}

function acceptCuti(id) {
    // Ambil file dari input
    var fileInput = document.getElementById('respon_blanko');
    var file = fileInput.files[0];

    // Buat FormData dan tambahkan file
    var formData = new FormData();
    formData.append('respon_blanko', file);
    formData.append('_token', '{{ csrf_token() }}');

    // Kirim permintaan AJAX untuk menerima cuti
    fetch(`{{ route('cuti.accept', $view->id) }}`, {
        method: 'POST',
        body: formData
    })
    // ...
}

function rejectCuti(id) {
    // Ambil file dari input
    var fileInput = document.getElementById('respon_blanko');
    var file = fileInput.files[0];

    // Buat FormData dan tambahkan file
    var formData = new FormData();
    formData.append('respon_blanko', file);
    formData.append('_token', '{{ csrf_token() }}');

    // Kirim permintaan AJAX untuk menolak cuti
    fetch(`{{ route('cuti.reject', $view->id) }}`, {
        method: 'POST',
        body: formData
    })
    // ...
}

function confirmBlanko(id) {
    // Ambil file dari input
    var fileInput = document.getElementById('respon_blanko');
    var file = fileInput.files[0];

    // Buat FormData dan tambahkan file
    var formData = new FormData();
    formData.append('respon_blanko', file);
    formData.append('_token', '{{ csrf_token() }}');

    // Kirim permintaan AJAX untuk konfirmasi cuti
    fetch(`{{ route('cuti.confirm', $view->id) }}`, {
        method: 'POST',
        body: formData
    })
    // ...
}
