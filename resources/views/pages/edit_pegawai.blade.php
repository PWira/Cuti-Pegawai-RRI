@extends('adminlte.layouts.app')

@section('content')

@auth

<head>
    <title>@php $title=" | Edit Pegawai"@endphp</title>
</head>

<body>
    <div class="card card-info card-outline mb-4">
        <div class="card-header" style="text-align:center;">
            <h3 class="">Edit Data Pegawai</h3>
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
            <form method="post" action="{{ route('update-pegawai', $pegawai->pid) }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row g-2">
                        <div class="">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_pekerja" id="nama_pekerja" placeholder="Nama Lengkap" value="{{ $pegawai->nama }}" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="int" class="form-control" name="umur" id="umur" placeholder="Contoh : 29" value="{{ $pegawai->umur }}" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nomor Induk Pekerja" value="{{ $pegawai->nip }}" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select form-select-sm" id="jk" name="jk" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki_laki" {{ $pegawai->jk == 'laki_laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="perempuan" {{ $pegawai->jk == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-select form-select-sm" id="jabatan" name="jabatan" required>
                                <option value="">Pilih Jabatan</option>
                                <option value="pranata_siaran_ahli_madya" {{ $pegawai->jabatan == 'pranata_siaran_ahli_madya' ? 'selected' : '' }}>Pranata Siaran Ahli Madya</option>
                                <option value="pranata_siaran_ahli_muda" {{ $pegawai->jabatan == 'pranata_siaran_ahli_muda' ? 'selected' : '' }}>Pranata Siaran Ahli Muda</option>
                                <option value="teknisi_siaran_ahli_madya" {{ $pegawai->jabatan == 'teknisi_siaran_ahli_madya' ? 'selected' : '' }}>Teknisi Siaran Ahli Madya</option>
                                <option value="teknisi_siaran_ahli_muda" {{ $pegawai->jabatan == 'teknisi_siaran_ahli_muda' ? 'selected' : '' }}>Teknisi Siaran Ahli Muda</option>
                            </select>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="unit_kerja" class="form-label">Unit Kerja RRI</label>
                            <select class="form-select form-select-sm" id="unit_kerja" name="unit_kerja" required>
                                <option value="{{$pegawai->unit_kerja}}">{{ucwords($pegawai->unit_kerja)}}</option>
                            </select>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="tahun_kerja" class="form-label">Masa Kerja : Tahun</label>
                            <input type="int" class="form-control" name="tahun_kerja" id="tahun_kerja" placeholder="Tanpa Tulisan. Contoh : 2" value="{{ floor($pegawai->masa_kerja / 12) }}" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="bulan_kerja" class="form-label">Masa Kerja : Bulan</label>
                            <input type="int" class="form-control" name="bulan_kerja" id="bulan_kerja" placeholder="Tanpa Tulisan. Contoh : 5" value="{{ $pegawai->masa_kerja % 12 }}" required>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="text-align: center">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <a href="{{ url('pegawai') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>

@endauth
@endsection