@extends('adminlte.layouts.app')

@section('content')

@auth

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
                    <div class="">
                        <label for="pegawai" class="form-label">Pilih Pegawai</label>
                        <select class="form-select form-select-sm" id="pegawai" name="pegawai" required>
                            <option value="">Pilih pegawai</option>
                            @forelse ($blanko as $pegawai)
                                <option value="{{ $pegawai->pid }}">{{ $pegawai->nama }}</option>
                            @empty
                                <option value="" class="text-danger text-center">Kosong! Isi terlebih dahulu data pegawai!</option>
                            @endforelse
                        </select>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label for="nama_pekerja" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_pekerja" id="nama_pekerja" placeholder="" readonly required>
                        </div>
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="" readonly required>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="" readonly required>
                        </div>
                        <div class="col-md-6">
                            <label for="unit_kerja" class="form-label">Unit Kerja RRI</label>
                            <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" placeholder="" readonly required>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun_kerja" class="form-label">Masa Kerja : Tahun</label>
                            <input type="text" class="form-control" name="tahun_kerja" id="tahun_kerja" placeholder="" readonly required>
                        </div>
                        <div class="col-md-3">
                            <label for="bulan_kerja" class="form-label">Masa Kerja : Bulan</label>
                            <input type="text" class="form-control" name="bulan_kerja" id="bulan_kerja" placeholder="" readonly required>
                        </div>
                        <p class="mt-2">Dengan ini mengajukan cuti dengan rincian sebagai berikut:</p>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                                <select class="form-select form-select-sm" id="jenis_cuti" name="jenis_cuti" required>
                                    <option value="">Pilih jenis cuti</option>
                                    <option value="cuti_tahunan">Cuti Tahunan</option>
                                    <option value="cuti_sakit">Cuti Sakit</option>
                                    <option value="cuti_melahirkan">Cuti Melahirkan</option>
                                    <option value="cuti_karena_alasan_penting">Cuti Karena Alasan Penting</option>
                                    <option value="cuti_di_luar_tanggungan_negara">Cuti Di Luar Tanggungan Negara</option>
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
                            <textarea class="form-control" id="alasan" name="alasan" rows="2" required maxlength="50"></textarea>
                            <small id="alasan-help" class="form-text text-muted">Maksimum 50 karakter</small>
                            <small id="alasan-warning" class="form-text text-danger d-none">Batas maksimun karakter</small>
                        </div>                        
                    </div>
                </div>
                <div class="card-footer" style="text-align: center">
                    <button class="btn btn-info" type="submit">Update Form</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const alasanTextarea = document.getElementById('alasan');
        const alasanHelp = document.getElementById('alasan-help');
        const alasanWarning = document.getElementById('alasan-warning');
        const pegawaiSelect = document.getElementById('pegawai');
        const namaPekerjaInput = document.getElementById('nama_pekerja');
        const nipInput = document.getElementById('nip');
        const jabatanInput = document.getElementById('jabatan');
        const unitKerjaInput = document.getElementById('unit_kerja');
        const tahunKerjaInput = document.getElementById('tahun_kerja');
        const bulanKerjaInput = document.getElementById('bulan_kerja');
    
        alasanTextarea.addEventListener('input', function () {
            const characterCount = alasanTextarea.value.length;
            alasanHelp.textContent = `Maximum 50 characters (${characterCount}/50)`;
    
            if (characterCount > 50) {
                alasanWarning.classList.remove('d-none');
            } else {
                alasanWarning.classList.add('d-none');
            }
        });
    
        pegawaiSelect.addEventListener('change', function () {
            const selectedPegawaiId = pegawaiSelect.value;
            const selectedPegawai = @json($blanko->keyBy('pid'));
    
            if (selectedPegawaiId) {
                namaPekerjaInput.value = selectedPegawai[selectedPegawaiId].nama;
                nipInput.value = selectedPegawai[selectedPegawaiId].nip;
                const jabatan = selectedPegawai[selectedPegawaiId].jabatan.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                jabatanInput.value = jabatan;
                unitKerjaInput.value = selectedPegawai[selectedPegawaiId].unit_kerja;
    
                const totalBulanKerja = selectedPegawai[selectedPegawaiId].masa_kerja;
                const tahunKerja = Math.floor(totalBulanKerja / 12);
                const bulanKerja = totalBulanKerja % 12;
    
                tahunKerjaInput.value = tahunKerja;
                bulanKerjaInput.value = bulanKerja;
            } else {
                namaPekerjaInput.value = '';
                nipInput.value = '';
                jabatanInput.value = '';
                unitKerjaInput.value = '';
                tahunKerjaInput.value = '';
                bulanKerjaInput.value = '';
            }
        });
    </script>       
</body>
@endauth
@endsection