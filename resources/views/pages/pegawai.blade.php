@extends('adminlte.layouts.app')

@section('content')


<body>
    <div class="card card-info card-outline mb-4">
        <div class="card-header" style="text-align:center;">
            <h3 class="">Data Pegawai</h3>
        </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="letter-container">
            <form method="post" action="/kirim-pengajuan" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_pekerja" id="nama_pekerja" placeholder="Nama Lengkap" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nomor Induk Pekerja" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="unit_kerja" class="form-label">Unit Kerja RRI</label>
                            <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" placeholder="Contoh : Palembang" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="tahun_kerja" class="form-label">Masa Kerja : Tahun</label>
                            <input type="int" class="form-control" name="tahun_kerja" id="tahun_kerja" placeholder="Tanpa Tulisan. Contoh : 2" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="bulan_kerja" class="form-label">Masa Kerja : Bulan</label>
                            <input type="int" class="form-control" name="bulan_kerja" id="bulan_kerja" placeholder="Tanpa Tulisan. Contoh : 5" required>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="text-align: center">
                    <button class="btn btn-info" type="submit">Daftarkan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const alasanTextarea = document.getElementById('alasan');
        const alasanHelp = document.getElementById('alasan-help');
        const alasanWarning = document.getElementById('alasan-warning');
    
        alasanTextarea.addEventListener('input', function () {
            const characterCount = alasanTextarea.value.length;
            alasanHelp.textContent = `Maximum 50 characters (${characterCount}/50)`;
    
            if (characterCount > 50) {
                alasanWarning.classList.remove('d-none');
            } else {
                alasanWarning.classList.add('d-none');
            }
        });
    </script>    
</body>
@endsection