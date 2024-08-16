@extends('adminlte.layouts.app')

@section('content')


<body>
    <div class="card card-info card-outline mb-4">
        <div class="card-header" style="text-align:center;">
            <h3 class="">Surat Pengantar Cuti</h3>
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
                <p>Yang bertanda tangan di bawah ini:</p>
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
                        <p class="mt-2">Dengan ini mengajukan cuti dengan rincian sebagai berikut:</p>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                                <select class="form-select form-select-sm" id="jenis_cuti" name="jenis_cuti" required>
                                    <option value="">Pilih jenis cuti</option>
                                    <option value="Cuti Tahunan">Cuti Tahunan</option>
                                    <option value="Cuti Sakit">Cuti Sakit</option>
                                    <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                    <option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
                                    <option value="Cuti Di Luar Tanggungan Negara">Cuti Di Luar Tanggungan Negara</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="mulai_cuti" class="form-label">Mulai Cuti</label>
                                <input type="date" class="form-control" id="mulai_cuti" name="mulai_cuti" required>
                            </div>
                            <div class="col-md-3">
                                <label for="selesai_cuti" class="form-label">Selesai Cuti</label>
                                <input type="date" class="form-control" id="selesai_cuti" name="selesai_cuti" required>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="alasan" class="form-label">Alasan Cuti</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="2" required></textarea>
                        </div>
                        <div class="mt-2">
                            <label for="blanko" class="form-label">PDF Blanko Surat Cuti</label>
                            <input type="file" class="form-control" id="blanko" name="blanko" accept="application/pdf" required>
                            <div class="progress" style="display: none;">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-info" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection