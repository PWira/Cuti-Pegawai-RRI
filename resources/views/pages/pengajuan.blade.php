@extends('adminlte.layouts.app')

@section('content')

@auth
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Pengajuan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tabel Pendataan
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="">
                    <div class="card mb-4"> <!-- AWALAN TABLE -->
                        <div class="card-header text-bg-warning">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 style="font-weight: bold" class="card-title">PENGAJUAN CUTI</h3>
                                @if ($role === 'user')
                                <a href="{{ url('pengajuan/semua') }}" class="btn btn-primary">Download DOC <i class="bi bi-file-text-fill"></i></a>
                                @endif
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">#</th>
                                        <th style="width: 13%" class="sortable">Nama Pekerja</th>
                                        <th style="width: 5%" class="sortable">NIP</th>
                                        <th style="width: 5%" class="sortable">Jabatan</th>
                                        <th style="width: 10%" class="sortable">Unit Kerja</th>
                                        <th style="width: 8%" class="sortable">Masa Kerja</th>
                                        <th style="width: 10%" class="sortable">Jenis Cuti</th>
                                        <th style="width: 10%" class="sortable">Tanggal Diajukan</th>
                                        <th style="width: 10%">Selengkapnya</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr class="align-middle">
                                            @php $rowNumber = 1; @endphp
                                            @forelse ($blanko as $view)
                                            @if($view->konfirmasi=="ditangguhkan")
                                            <td>{{ $rowNumber++ }}</td>
                                            <td>{{$view->nama_pekerja}}</td>
                                            <td>{{$view->nip}}</td>
                                            <td>{{$view->jabatan}}</td>
                                            <td>{{ucfirst($view->unit_kerja)}}</td>
                                            <td>
                                                @php
                                                    $years = floor($view->masa_kerja / 12);
                                                    $months = $view->masa_kerja % 12;
                                                @endphp
                                                {{ $years }} tahun {{ $months }} bulan
                                            </td>
                                            <td>{{ format_jenis_cuti($view->jenis_cuti) }}</td>
                                            <td>
                                                <p>{{ \Carbon\Carbon::parse($view->created_at)->format('d-m-Y') }}</p>
                                            </td>
                                            <td>
                                                <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->id }}" aria-expanded="false" aria-controls="collapse{{ $view->id }}" class="btn btn-secondary">Detail <i class="bi bi-arrow-down"></i></a>
                                                {{-- <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->id }}" aria-expanded="false" aria-controls="collapse{{ $view->id }}">
                                                    Detail<i class="bi bi-arrow-down"></i>
                                                </button> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9">
                                                <div class="collapse" id="collapse{{ $view->id }}">
                                                    <div class="card card-body">
                                                        <span class="d-flex justify-content-between">
                                                            <p>Dibuat Oleh: {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }} {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} {{ucwords(str_replace('_', ' ', $view->oleh_asal))}}</p>
                                                        </span>
                                                        <span class="d-flex justify-content-between">
                                                            <p>Mulai Cuti : {{ \Carbon\Carbon::parse($view->mulai_cuti)->format('d-m-Y') }}</p>
                                                            <p>Selesai Cuti : {{ \Carbon\Carbon::parse($view->selesai_cuti)->format('d-m-Y') }}</p>
                                                            <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti))) }} hari</p>
                                                        </span>
                                                        <p>Alasan: {{ $view->alasan }}</p>
                                                        @if ($role === "super_user")
                                                        <p class="d-flex justify-content-between">
                                                            <span>
                                                                @if ($view->jenis_cuti!="cuti_sakit")
                                                                    <input class="btn btn-primary" type="file" id="blankoInput_{{ $view->id }}" accept="application/pdf" required>
                                                                    <button class="btn btn-success" onclick="return confirmResponCuti('diterima', {{ $view->id }})">Diterima <i class="bi bi-check"></i></button>
                                                                    <button class="btn btn-danger" onclick="return confirmResponCuti('ditolak', {{ $view->id }})">Ditolak <i class="bi bi-x"></i></button>
                                                                    {{-- <button class="btn btn-success" onclick="responCuti('diterima', {{ $view->id }})">Diterima <i class="bi bi-check"></i></button>
                                                                    <button class="btn btn-danger" onclick="responCuti('ditolak', {{ $view->id }})">Ditolak <i class="bi bi-x"></i></button> --}}
                                                                @elseif ($view->jenis_cuti=="cuti_sakit")
                                                                    <input class="btn btn-primary" type="file" id="fileSakit_{{ $view->id }}" accept="application/pdf" required>
                                                                    <button class="btn btn-success" onclick="return confirmSakitCuti('diterima', {{ $view->id }})">Diterima <i class="bi bi-check"></i></button>
                                                                    <button class="btn btn-danger" onclick="return confirmSakitCuti('ditolak', {{ $view->id }})">Ditolak <i class="bi bi-x"></i></button>
                                                                    {{-- <button class="btn btn-success" onclick="responSakit('sakit', {{ $view->id }})">Dikonfirmasi <i class="bi bi-check"></i></button>
                                                                    <button class="btn btn-danger" onclick="responSakit('ditolak', {{ $view->id }})">Ditolak <i class="bi bi-x"></i></button> --}}
                                                                @endif
                                                            </span>
                                                        @elseif($role === "user" || $role === "admin")
                                                            <a class="btn btn-danger" onclick="confirmDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
                                                        @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="9">No data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $blanko->render('layouts/pagination') }}
                            </div>
                            
{{-- ====================================================  SAKIT  ====================================================== --}}

                <div class="card mb-4"> <!-- AWALAN TABLE -->
                    <div class="card-header text-bg-warning">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 style="font-weight: bold" class="card-title">Cuti Sakit yang Sudah Dikonfirmasi</h3>
                            {{-- <a href="{{ url('pengajuan/semua') }}" class="btn btn-primary">Download DOC</a> --}}
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 2%">#</th>
                                    <th style="width: 15%">Nama Pekerja</th>
                                    <th style="width: 5%">NIP</th>
                                    <th style="width: 10%">Jabatan</th>
                                    <th style="width: 5%">Unit Kerja</th>
                                    <th style="width: 8%">Masa Kerja</th>
                                    <th style="width: 10%">Jenis Cuti</th>
                                    <th style="width: 10%">Blanko</th>
                                    <th style="width: 10%">Selengkapnya</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        @php $rowNumber = 1; @endphp
                                        @forelse ($blanko as $view)
                                        @if ($view->konfirmasi=="sakit")
                                        <td>{{ $rowNumber++ }}</td>
                                        <td>{{$view->nama_pekerja}}</td>
                                        <td>{{$view->nip}}</td>
                                        <td>{{$view->jabatan}}</td>
                                        <td>{{ucfirst($view->unit_kerja)}}</td>
                                        <td>
                                            @php
                                                $years = floor($view->masa_kerja / 12);
                                                $months = $view->masa_kerja % 12;
                                            @endphp
                                            {{ $years }} tahun {{ $months }} bulan
                                        </td>
                                        <td>{{ format_jenis_cuti($view->jenis_cuti) }}</td>
                                        <td>
                                            <a href="{{$view->sakit_ditangguhkan}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->id }}" aria-expanded="false" aria-controls="collapse{{ $view->id }}">
                                                Selengkapnya <i class="bi bi-arrow-down"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <div class="collapse" id="collapse{{ $view->id }}">
                                                <div class="card card-body">
                                                    <span class="d-flex justify-content-between">
                                                        <p>Dibuat Oleh: {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }} {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} {{ucwords(str_replace('_', ' ', $view->oleh_asal))}}</p>
                                                    </span>
                                                    <span class="d-flex justify-content-between">
                                                        <p>Diajukan Tanggal: {{ \Carbon\Carbon::parse($view->created_at)->format('d-m-Y') }}</p>
                                                        <p>Mulai Cuti : {{ \Carbon\Carbon::parse($view->mulai_cuti)->format('d-m-Y') }}</p>
                                                        <p>Selesai Cuti : {{ \Carbon\Carbon::parse($view->selesai_cuti)->format('d-m-Y') }}</p>
                                                        <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti))) }} hari</p>
                                                    </span>
                                                    <p>Alasan: {{ $view->alasan }}</p>
                                                    <p class="d-flex justify-content-between">
                                                        <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal<i class="bi bi-file-text-fill"></i></a>
                                                    @if ($role === "super_user" && $jabatan === "direktur")
                                                        <span>
                                                            <input class="btn btn-primary" type="file" id="fileBalasanSakit_{{ $view->id }}" accept="application/pdf" required>
                                                            <button class="btn btn-success" onclick="return confirmSakitCuti('diterima', {{ $view->id }})">Diterima <i class="bi bi-check"></i></button>
                                                            <button class="btn btn-danger" onclick="return confirmSakitCuti('ditolak', {{ $view->id }})">Ditolak <i class="bi bi-x"></i></button>
                                                            {{-- <button class="btn btn-info" onclick="balasanSakit('diterima', {{ $view->id }})">Diterima <i class="bi bi-check"></i></button>
                                                            <button class="btn btn-danger" onclick="balasanSakit('ditolak', {{ $view->id }})">Ditolak <i class="bi bi-x"></i></button> --}}
                                                        </span>
                                                    @elseif ($role === "user" || $role === "admin")
                                                        <a class="btn btn-danger" onclick="confirmDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
                                                    @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    @endif  
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="9">No data available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $blanko->render('layouts/pagination') }}
                    </div>
                </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->

<script>
    
    function confirmResponCuti(status, bid) {
        if (confirm("Kirim Respon? Pastikan blanko yang dikirim benar!")) {
            responCuti(status, bid);
        }
        return false;
    }

    function responCuti(status, bid) {
        const fileInput = document.getElementById('blankoInput_' + bid);
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file to upload.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);
        formData.append('status', status);
        formData.append('id', bid);

        fetch('{{ route("respon.cuti") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload(); // Refresh the page to reflect the changes
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function confirmSakitCuti(status, sid) {
        if (confirm("Kirim Respon? Pastikan blanko yang dikirim benar!")) {
            responSakit(status, sid);
        }
        return false;
    }

    function responSakit(status, sid) {
        const fileInput = document.getElementById('fileSakit_' + sid);
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file to upload.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);
        formData.append('status', status);
        formData.append('id', sid);

        fetch('{{ route("respon.sakit") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload(); // Refresh the page to reflect the changes
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function confirmBalasanSakitCuti(status, bsid) {
        if (confirm("Kirim Respon? Pastikan blanko yang dikirim benar!")) {
            balasanSakit(status, bsid);
        }
        return false;
    }

    function balasanSakit(status, bsid) {
        const fileInput = document.getElementById('fileBalasanSakit_' + bsid);
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file to upload.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);
        formData.append('status', status);
        formData.append('id', bsid);

        fetch('{{ route("respon.cuti") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload(); // Refresh the page to reflect the changes
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endauth
@endsection