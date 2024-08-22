@extends('adminlte.layouts.app')

@section('content')

@auth
@foreach ($konfirmasi as $item)
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Pendataan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                        @switch($item->konfirmasi)

{{-- ====================================================  DITANGGUHKAN  ====================================================== --}}

                            @case('ditangguhkan')
                                <div class="card-header">
                                    <h3 style="font-weight: bold" class="card-title">Pengajuan Cuti</h3>
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
                                                <td>{{ $rowNumber++ }}</td>
                                                <td>{{$view->nama_pekerja}}</td>
                                                <td>{{$view->nip}}</td>
                                                <td>{{$view->jabatan}}</td>
                                                <td>{{$view->unit_kerja}}</td>
                                                <td>
                                                    @php
                                                        $years = floor($view->masa_kerja / 12);
                                                        $months = $view->masa_kerja % 12;
                                                    @endphp
                                                    {{ $years }} tahun {{ $months }} bulan
                                                </td>
                                                <td>{{$view->jenis_cuti}}</td>
                                                <td>
                                                    <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
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
                                                            <p>Mulai Cuti: {{ $view->mulai_cuti }}</p>
                                                            <p>Selesai Cuti: {{ $view->selesai_cuti }}</p>
                                                            <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti))) }} hari</p>
                                                            <p>Alasan: {{ $view->alasan }}</p>
                                                            <p class="d-flex justify-content-between">
                                                                <span>
                                                                    <input class="btn btn-primary" type="file" id="fileInput_{{ $item->id }}" accept="application/pdf" required>
                                                                    <button class="btn btn-success" onclick="responCuti('diterima', {{ $item->id }})">Diterima <i class="bi bi-check"></i></button>
                                                                    <button class="btn btn-danger" onclick="responCuti('ditolak', {{ $item->id }})">Ditolak <i class="bi bi-x"></i></button>
                                                                </span>
                                                                @if ($role === "admin")
                                                                    <a class="btn btn-danger" onclick="confirmDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
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
                                @break

{{-- ====================================================  DITERIMA  ====================================================== --}}

                            @case('diterima')
                                <div class="card-header">
                                    <h3 style="font-weight: bold" class="card-title">Cuti Diterima</h3>
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
                                                <td>{{ $rowNumber++ }}</td>
                                                <td>{{$view->nama_pekerja}}</td>
                                                <td>{{$view->nip}}</td>
                                                <td>{{$view->jabatan}}</td>
                                                <td>{{$view->unit_kerja}}</td>
                                                <td>
                                                    @php
                                                        $years = floor($view->masa_kerja / 12);
                                                        $months = $view->masa_kerja % 12;
                                                    @endphp
                                                    {{ $years }} tahun {{ $months }} bulan
                                                </td>
                                                <td>{{$view->jenis_cuti}}</td>
                                                <td>
                                                    <a href="{{$view->blanko_diterima}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
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
                                                            <p>Mulai Cuti: {{ $view->mulai_cuti }}</p>
                                                            <p>Selesai Cuti: {{ $view->selesai_cuti }}</p>
                                                            <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti))) }} hari</p>
                                                            <p>Alasan: {{ $view->alasan }}</p>
                                                            <p class="d-flex justify-content-between">
                                                                <span>
                                                                    <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal <i class="bi bi-file-text-fill"></i></a>
                                                                </span>
                                                                @if ($role === "admin")
                                                                    <a class="btn btn-danger" onclick="confirmDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
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
                                @break

{{-- ====================================================  DITOLAK  ====================================================== --}}

                            @case('ditolak')
                                <div class="card-header">
                                    <h3 style="font-weight: bold" class="card-title">Cuti Ditolak</h3>
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
                                                <td>{{ $rowNumber++ }}</td>
                                                <td>{{$view->nama_pekerja}}</td>
                                                <td>{{$view->nip}}</td>
                                                <td>{{$view->jabatan}}</td>
                                                <td>{{$view->unit_kerja}}</td>
                                                <td>
                                                    @php
                                                        $years = floor($view->masa_kerja / 12);
                                                        $months = $view->masa_kerja % 12;
                                                    @endphp
                                                    {{ $years }} tahun {{ $months }} bulan
                                                </td>
                                                <td>{{$view->jenis_cuti}}</td>
                                                <td>
                                                    <a href="{{$view->blanko_ditolak}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
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
                                                            <p>Mulai Cuti: {{ $view->mulai_cuti }}</p>
                                                            <p>Selesai Cuti: {{ $view->selesai_cuti }}</p>
                                                            <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti))) }} hari</p>
                                                            <p>Alasan: {{ $view->alasan }}</p>
                                                            <p class="d-flex justify-content-between">
                                                                <span>
                                                                    <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal <i class="bi bi-file-text-fill"></i></a>
                                                                </span>
                                                                @if ($role === "admin")
                                                                    <a class="btn btn-danger" onclick="confirmDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
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
                                @break

{{-- ====================================================  KOSONG  ====================================================== --}}

                            @default
                                <div class="card-header">
                                    <h3 style="font-weight: bold" class="card-title">Tabel Isi</h3>
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
                                                <tr class="text-center">
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{ $blanko->render('layouts/pagination') }}
                                </div>
                        @endswitch
                    </div> <!-- /.card -->
                    {{-- @forelse ($blanko as $view)
                    <iframe src="{{ $view->blanko_ditangguhkan }}" width="100%" height="100%"></iframe>
                    @empty
                        <br>
                    @endforelse --}}
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->
<script>
    function responCuti(status, id) {
        const fileInput = document.getElementById('fileInput_' + id);
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file to upload.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);
        formData.append('status', status);
        formData.append('id', id);

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
@endforeach
@endauth
@endsection