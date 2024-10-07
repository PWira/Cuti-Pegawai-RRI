@extends('adminlte.layouts.app')

@section('content')

@auth

<head>
    <title>@php $title=" | Daftarkan Pegawai"@endphp</title>
  </head>

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
            <form method="post" action="/daftar-pegawai" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row g-2">
                        <div class="">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_pekerja" id="nama_pekerja" placeholder="Nama Lengkap" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="int" class="form-control" name="umur" id="umur" placeholder="Contoh : 29" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nomor Induk Pekerja" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select form-select-sm" id="jk" name="jk" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki_laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status Pernikahan</label>
                            <select class="form-select form-select-sm" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="belum_menikah">Belum Menikah</option>
                                <option value="sudah_menikah">Sudah Menikah</option>
                                <option value="cerai_hidup">Cerai Hidup</option>
                                <option value="cerai_mati">Cerai Mati</option>
                            </select>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-select form-select-sm" id="jabatan" name="jabatan" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="pranata_siaran_ahli_madya">Pranata Siaran Ahli Madya</option>
                                <option value="pranata_siaran_ahli_muda">Pranata Siaran Ahli Muda</option>
                                <option value="teknisi_siaran_ahli_madya">Teknisi Siaran Ahli Madya</option>
                                <option value="teknisi_siaran_ahli_muda">Teknisi Siaran Ahli Muda</option>
                            </select>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="unit_kerja" class="form-label">Unit Kerja RRI</label>
                            <select class="form-select form-select-sm" id="unit_kerja" name="unit_kerja" required>

                                {{-- <option value="">Pilih Unit Kerja</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Palembang">Palembang</option>
                                <option value="Medan">Medan</option>
                                <option value="Yogyakarta">Yogyakarta</option> --}}

                                <option value="{{$asal}}">{{ucwords($asal)}}</option>
                            </select>
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

@endauth
@endsection