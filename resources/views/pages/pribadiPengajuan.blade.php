@extends('adminlte.layouts.app')

@section('content')

@auth

<head>
    <title>@php $title=" | Pengajuan Saya"@endphp</title>
</head>

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
                            Tabel Pengajuan Cuti Anda
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
                        <div class="card-header text-bg-white">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 style="font-weight: bold" class="card-title">PENGAJUAN CUTI ANDA</h3>
                                <div class="d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="monthSelect" class="form-select">
                                            <option value="">Pilih Bulan</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" id="yearInput" class="form-control" placeholder="Masukkan Tahun">
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" id="downloadDoc" class="btn btn-primary">Download PDF <i class="bi bi-file-text-fill"></i></a>
                                    </div>
                                </div>                                
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="search-container text-end">
                                <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari data..." style="display: none;">
                                <button id="searchToggle" class="btn btn-success">Search <i class="bi bi-search"></i></button>
                            </div>
                            <br>
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">No</th>
                                        <th style="" class="sortable">Nama Pekerja</th>
                                        <th style="" class="sortable">NIP</th>
                                        <th style="" class="sortable">Jabatan</th>
                                        <th style="" class="sortable">Unit Kerja</th>
                                        <th style="" class="sortable">Masa Kerja</th>
                                        <th style="" class="sortable">Jenis Cuti</th>
                                        <th style="" class="sortable">Status</th>
                                        <th style="" class="sortable">Tanggal Diterima</th>
                                        <th style="">Selengkapnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $rowNumber = 1; @endphp
                                    @forelse ($blanko as $view)
                                    @php $cekstatus = $view->konfirmasi @endphp
                                    <tr class="align-middle">
                                        <td>{{ $rowNumber++ }}</td>
                                        <td>{{$view->nama_pekerja}}</td>
                                        <td>{{$view->nip}}</td>
                                        <td>{{ format_jabatan($view->jabatan) }}</td>
                                        <td>{{ucfirst($view->nama_unit_kerja)}}</td>
                                        <td>
                                            @php
                                                $years = floor($view->masa_kerja / 12);
                                                $months = $view->masa_kerja % 12;
                                            @endphp
                                            {{ $years }} tahun {{ $months }} bulan
                                        </td>
                                        <td>{{ format_jenis_cuti($view->jenis_cuti) }}</td>
                                        <td>
                                            @switch($cekstatus)
                                                @case("ditangguhkan")
                                                    <span class="text-warning">{{ucwords($view->konfirmasi)}}</span>
                                                    @break
                                                @case("sakit")
                                                    <span class="text-success">{{ucwords($view->konfirmasi)}}</span>
                                                    @break
                                                @case("diterima")
                                                    <span class="text-info">{{ucwords($view->konfirmasi)}}</span>
                                                    @break
                                                @case("ditolak")
                                                    <span class="text-danger">{{ucwords($view->konfirmasi)}}</span>
                                                    @break
                                                @default
                                                    <span>{{ucwords($view->konfirmasi)}}</span>
                                            @endswitch
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($view->updated_at)->locale('id')->translatedFormat('d F Y') }}</td>
                                        <td class="text-center">
                                            @switch($cekstatus)
                                                @case("ditangguhkan")
                                                    <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                                    @break
                                                @case("sakit")
                                                    <a href="{{$view->sakit_ditangguhkan}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                                    @break
                                                @case("diterima")
                                                    <a href="{{$view->blanko_diterima}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                                    @break
                                                @case("ditolak")
                                                    <a href="{{$view->blanko_ditolak}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                                    @break
                                                @default
                                                    <a href="#" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                            @endswitch
                                            <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->bid }}" aria-expanded="false" aria-controls="collapse{{ $view->bid }}" class="btn btn-secondary">Detail <i class="bi bi-arrow-down"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="100">
                                            <div class="collapse" id="collapse{{ $view->bid }}">
                                                <div class="card card-body">
                                                    <div class="d-flex content-between">
                                                        <div class="col-md-3">
                                                            <p>Dibuat Oleh: {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }}</p>
                                                            <p>Jabatan : {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} </p>
                                                            <p>NIP : {{ucwords(str_replace('_', ' ', $view->oleh_nip))}}</p>
                                                            <p>Alamat Selama Cuti: {{ $view->tujuan_cuti }}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>Mulai Cuti: {{ \Carbon\Carbon::parse($view->mulai_cuti)->locale('id')->translatedFormat('d F Y') }}</p>
                                                            <p>Selesai Cuti: {{ \Carbon\Carbon::parse($view->selesai_cuti)->locale('id')->translatedFormat('d F Y') }}</p>
                                                            <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti))) + 1 }} hari</p>
                                                            <p>Alasan: {{ $view->alasan }}</p>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <p>Keterangan Cuti (untuk rekpitulasi) : {{ $view->keterangan }}</p>
                                                        </div>
                                                    </div>
                                                    <span class="d-flex justify-content-between">
                                                        <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal<i class="bi bi-file-text-fill"></i></a>
                                                        @if($cekstatus =="ditangguhkan")
                                                            <a class="btn btn-danger" onclick="confirmDeletePersonal({{$view->bid}})">HAPUS <i class="bi bi-trash"></i></a>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    {{-- <tr class="text-center">
                                        <td colspan="100">No data available</td>
                                    </tr> --}}
                                    @endforelse
                                </tbody>
                            </table>
                            
                            </div> <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $blanko->render('layouts/pagination') }}
                            </div>
                </div> <!-- /.col -->
            <div class="mb-4">
                <p>KETERANGAN STATUS</p>
                <ul style="list-style-type:disc;">
                    <li>Ditangguhkan = Pengajuan cuti belum direspon (dapat dihapus)</li>
                    <li>Sakit        = Sudah direspon, menunggu respon Direktur RRI</li>
                    <li>Diterima     = Pengajuan cuti diterima</li>
                    <li>Ditolak      = Pengajuan cuti ditolak</li>
                </ul> 
            </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const table = document.getElementById('myTable');
    //     const rows = table.querySelectorAll('tbody tr');
    //     const searchInput = document.getElementById('searchInput');
    //     const searchToggle = document.getElementById('searchToggle');
    //     let searchVisible = false;

    //     // Toggle to show/hide search input
    //     searchToggle.addEventListener('click', function() {
    //         searchVisible = !searchVisible;
    //         searchInput.style.display = searchVisible ? 'inline-block' : 'none';
    //     });

    //     // Function to filter table rows based on partial matching
    //     function updateTable() {
    //         const filter = searchInput.value.toLowerCase().trim();

    //         rows.forEach(row => {
    //             const shouldShow = Array.from(row.children).slice(1, -1).some(cell => {
    //                 const cellText = cell.textContent.toLowerCase().trim();
    //                 return cellText.includes(filter);
    //             });
    //             row.style.display = shouldShow ? '' : 'none';
    //         });
    //     }

    //     // Attach event listener to search input for real-time filtering
    //     searchInput.addEventListener('input', updateTable);

    //     // Sorting functionality (optional)
    //     const headers = table.querySelectorAll('th.sortable');
    //     headers.forEach((header, index) => {
    //         header.addEventListener('click', () => {
    //             const isAscending = header.classList.contains('asc');
    //             const sortedRows = Array.from(rows).sort((a, b) => {
    //                 const aValue = a.children[index].textContent.trim();
    //                 const bValue = b.children[index].textContent.trim();
    //                 return isAscending ? bValue.localeCompare(aValue) : aValue.localeCompare(bValue);
    //             });

    //             sortedRows.forEach(row => table.querySelector('tbody').appendChild(row));

    //             headers.forEach(h => h.classList.remove('asc', 'desc'));
    //             header.classList.toggle('asc', !isAscending);
    //             header.classList.toggle('desc', isAscending);
    //         });
    //     });

    //     const downloadButton = document.getElementById('downloadDoc');
    //     const monthSelect = document.getElementById('monthSelect');
    //     const yearInput = document.getElementById('yearInput');

    //     // Set tahun default ke tahun sekarang
    //     const currentYear = new Date().getFullYear();
    //     yearInput.value = currentYear;

    //     // Set min dan max untuk input tahun
    //     yearInput.min = "2000"; // Sesuaikan dengan kebutuhan
    //     yearInput.max = currentYear.toString();

    //     if (downloadButton && monthSelect && yearInput) {
    //         downloadButton.addEventListener('click', function(e) {
    //             e.preventDefault();
    //             const selectedMonth = monthSelect.value;
    //             const selectedYear = yearInput.value;

    //             if (selectedMonth && selectedYear) {
    //                 if (selectedYear < 2000 || selectedYear > currentYear) {
    //                     alert('Silakan masukkan tahun antara 2000 dan ' + currentYear);
    //                 } else {
    //                     window.location.href = `/generate-pdf?month=${selectedMonth}&year=${selectedYear}`;
    //                 }
    //             } else {
    //                 alert('Silakan pilih bulan dan masukkan tahun sebelum mengunduh.');
    //             }
    //         });
    //     }
    // });
</script>
@endauth
@endsection