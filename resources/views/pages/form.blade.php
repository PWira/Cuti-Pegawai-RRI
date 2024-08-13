@extends('adminlte.layouts.app')

@section('content')
<body>
    <div class="card card-info card-outline mb-4"> <!--begin::Header-->
        <div class="card-header" style="text-align:center;">
            <h3 class="">Surat Pengantar Cuti</h3>
        </div> <!--end::Header--> <!--begin::Form-->
        <!-- <p></p> -->
        <div class="letter-container">
            <form method="post" action="/kirim-pengajuan" class="needs-validation"> <!--begin::Body-->
                @csrf
                <p>Yang bertanda tangan di bawah ini:</p>
                <div class="card-body"> <!--begin::Row-->
                    <div class="row g-2"> <!--begin::Col-->
                        <div class="col-md-6"> <label for="nama" class="form-label">Nama Lengkap</label> <input type="text" class="form-control" name="nama_pekerja" id="nama_pekerja" placeholder="Nama Lengkap" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6"> <label for="nip" class="form-label">NIP</label> <input type="text" class="form-control" name="nip" id="nip" placeholder="Nomor Induk Pekerja" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6"> <label for="jabatan" class="form-label">Jabatan</label> <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6"> <label for="unit_kerja" class="form-label">Unit Kerja</label> <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" placeholder="departemen" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6"> <label for="masa_kerja" class="form-label">Masa Kerja</label> <input type="int" class="form-control" name="masa_kerja" id="masa_kerja" placeholder="Cukup angka Dalam bulan. Contoh : 13" required>
                            <div class="valid-feedback"></div>
                        </div> <!--end::Col--> <!--begin::Col-->
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

                    </div> <!--end::Row-->
                </div> <!--end::Body--> <!--begin::Footer-->
                <div class="card-footer"> <button class="btn btn-info" type="submit">Submit form</button> </div> <!--end::Footer-->
            </form> <!--end::Form--> <!--begin::JavaScript-->
        </div>
    </div> <!--end::Form Validation-->
</body>
@endsection