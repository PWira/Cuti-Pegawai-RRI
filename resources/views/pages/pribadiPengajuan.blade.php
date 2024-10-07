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
                                @if ($role === 'super_user')
                                <div class="d-flex align-items-center">
                                    <div class="col-md-6">
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
                                    <div class="col-md-8">
                                        <a href="#" id="downloadDoc" class="btn btn-primary">Download PDF <i class="bi bi-file-text-fill"></i></a>
                                    </div>
                                </div>                                
                                @endif
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-end">
                                <button id="searchToggle" class="btn btn-success col-md-2">Search <i class="bi bi-search"></i></button>
                            </div>
                            <br>
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 2%"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="Nama Pekerja" style="display: none;"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="NIP" style="display: none;"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="Jabatan" style="display: none;"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="Unit Kerja" style="display: none;"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="Masa Kerja" style="display: none;"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="Jenis Cuti" style="display: none;"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="Status" style="display: none;"></th>
                                        <th><input type="text" class="form-control search-input" placeholder="Tanggal Diterima" style="display: none;"></th>
                                        <th>
                                        </th>
                                    </tr>
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
                                        <tr class="align-middle">
                                            @php $rowNumber = 1; @endphp
                                            @forelse ($blanko as $view)
                                            @php $cekstatus = $view->konfirmasi @endphp
                                            @if($view->oleh_user === $name && $view->oleh_asal === $asal && $view->oleh_jabatan === $jabatan)
                                            <td>{{ $rowNumber++ }}</td>
                                            <td>{{$view->nama_pekerja}}</td>
                                            <td>{{$view->nip}}</td>
                                            <td>{{ format_jabatan($view->jabatan) }}</td>
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
                                            @if ($cekstatus === "ditangguhkan")
                                                <span class="text-warning">{{ucwords($view->konfirmasi)}}</span>
                                            @elseif ($cekstatus === "sakit")
                                                <span class="text-success">{{ucwords($view->konfirmasi)}}</span>
                                            @elseif ($cekstatus === "diterima")
                                                <span class="text-success">{{ucwords($view->konfirmasi)}}</span>
                                            @elseif ($cekstatus === "ditolak")
                                                <span class="text-danger">{{ucwords($view->konfirmasi)}}</span>
                                            @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($view->updated_at)->locale('id')->translatedFormat('d F Y') }}</td>
                                            <td class="text-center">
                                                @if ($cekstatus === "ditangguhkan")
                                                <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                            @elseif ($cekstatus === "sakit")
                                                <a href="{{$view->sakit_ditangguhkan}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                            @elseif ($cekstatus === "diterima")
                                                <a href="{{$view->blanko_diterima}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                            @elseif ($cekstatus === "ditolak")
                                                <a href="{{$view->blanko_ditolak}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                            @endif
                                                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->bid }}" aria-expanded="false" aria-controls="collapse{{ $view->bid }}" class="btn btn-secondary">Detail <i class="bi bi-arrow-down"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="100">
                                                <div class="collapse" id="collapse{{ $view->bid }}">
                                                    <div class="card card-body">
                                                        <span class="d-flex justify-content-between">
                                                            <p>Dibuat Oleh : {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }} {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} {{ucwords(str_replace('_', ' ', $view->oleh_asal))}}</p>
                                                        </span>
                                                        <span class="d-flex">
                                                            <p>Alamat Selama Cuti : {{ $view->tujuan_cuti}}</p>
                                                            <p style="margin-left: 40px;">Mulai Cuti : {{ \Carbon\Carbon::parse($view->mulai_cuti)->locale('id')->translatedFormat('d F Y') }}</p>
                                                            <p style="margin-left: 40px;">Selesai Cuti : {{ \Carbon\Carbon::parse($view->selesai_cuti)->locale('id')->translatedFormat('d F Y') }}</p>
                                                            <p style="margin-left: 40px;">Lamanya Cuti : {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti)))+1 }} hari</p>
                                                        </span>    
                                                        <span class="d-flex">                                                    
                                                        <p>Alasan : {{ $view->alasan }}</p>
                                                        <p style="margin-left: 40px;">Keterangan Cuti (untuk rekpitulasi) : {{ $view->keterangan }}</p>
                                                        </span>
                                                        <span class="d-flex justify-content-between">
                                                        <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal<i class="bi bi-file-text-fill"></i></a>
                                                        @if($cekstatus =="ditangguhkan")
                                                            <a class="btn btn-danger" onclick="confirmDeletePersonal({{$view->bid}})">HAPUS <i class="bi bi-trash"></i></a>
                                                        {{-- @elseif($cekstatus =="diterima")
                                                        <span>
                                                            <textarea class="form-control" id="alasan" name="alasan" rows="2" required maxlength="50"></textarea>
                                                            <small id="alasan-help" class="form-text text-muted">Maksimum 50 karakter</small>
                                                            <small id="alasan-warning" class="form-text text-danger d-none">Batas maksimun karakter</small>
                                                            <a class="btn btn-danger" onclick="confirmDeletePersonal({{$view->bid}})">HAPUS <i class="bi bi-trash"></i></a>
                                                        </span> --}}
                                                        @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
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
    
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('myTable');
        const rows = table.querySelectorAll('tbody tr');
        const searchInputs = document.querySelectorAll('.search-input');
        const searchToggle = document.getElementById('searchToggle');
        let searchVisible = false;

        // Toggle to show/hide search inputs
        searchToggle.addEventListener('click', function() {
            searchVisible = !searchVisible;
            searchInputs.forEach(input => {
                input.style.display = searchVisible ? 'inline-block' : 'none';
            });
        });

        // Function to filter table rows based on prefix matching
        function updateTable() {
            const filters = Array.from(searchInputs).map(input => input.value.toLowerCase().trim());

            rows.forEach(row => {
                const shouldShow = Array.from(row.children).slice(1, -1).every((cell, index) => {
                    const cellText = cell.textContent.toLowerCase().trim();
                    const filterValue = filters[index];

                    if (filterValue) {
                        // Use startsWith to ensure the search query matches from the beginning of the string
                        return cellText.startsWith(filterValue);
                    }
                    return true;  // If no filter for this column, don't filter on it
                });
                row.style.display = shouldShow ? '' : 'none';
            });
        }

        // Attach event listeners to search inputs for real-time filtering
        searchInputs.forEach(input => {
            input.addEventListener('input', updateTable);
        });

        // Sorting functionality (optional)
        const headers = table.querySelectorAll('th.sortable');
        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                const isAscending = header.classList.contains('asc');
                const sortedRows = Array.from(rows).sort((a, b) => {
                    const aValue = a.children[index].textContent.trim();
                    const bValue = b.children[index].textContent.trim();
                    return isAscending ? bValue.localeCompare(aValue) : aValue.localeCompare(bValue);
                });

                sortedRows.forEach(row => table.querySelector('tbody').appendChild(row));

                headers.forEach(h => h.classList.remove('asc', 'desc'));
                header.classList.toggle('asc', !isAscending);
                header.classList.toggle('desc', isAscending);
            });
        });

        // Handle month-based PDF generation
        const downloadButton = document.getElementById('downloadDoc');
        const monthSelect = document.getElementById('monthSelect');

        if (downloadButton && monthSelect) {
            downloadButton.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedMonth = monthSelect.value;
                if (selectedMonth) {
                    window.location.href = `/generate-pdf?month=${selectedMonth}`;
                } else {
                    alert('Please select a month before downloading.');
                }
            });
        }
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     const table = document.getElementById('myTable');
    //     const rows = table.querySelectorAll('tbody tr');
    //     const searchInputs = document.querySelectorAll('.search-input');
    //     const searchToggle = document.getElementById('searchToggle');
    //     let searchVisible = false;

    //     // Show/hide search inputs when the search button is clicked
    //     searchToggle.addEventListener('click', function() {
    //         searchVisible = !searchVisible;
    //         searchInputs.forEach(input => {
    //             input.style.display = searchVisible ? 'inline-block' : 'none';
    //         });
    //     });

    //     // Function to update the table based on search input
    //     function updateTable() {
    //         const filters = Array.from(searchInputs).map(input => input.value.toLowerCase().trim());

    //         rows.forEach(row => {
    //             const shouldShow = Array.from(row.children).slice(1, -1).every((cell, index) => {
    //                 const cellText = cell.textContent.toLowerCase().trim();
    //                 const filterValue = filters[index];

    //                 if (filterValue) {
    //                     // Use includes to allow partial matches, maintaining letter order
    //                     return cellText.includes(filterValue);
    //                 }
    //                 return true;  // No filter for this column, so do not filter this column
    //             });
    //             row.style.display = shouldShow ? '' : 'none';
    //         });
    //     }

    //     // Add event listeners to the search inputs to filter the table as the user types
    //     searchInputs.forEach(input => {
    //         input.addEventListener('input', updateTable);
    //     });

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
</script>
@endauth
@endsection