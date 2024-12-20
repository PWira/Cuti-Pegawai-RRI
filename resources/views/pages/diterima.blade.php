@extends('adminlte.layouts.app')

@section('content')
<head>
<title>@php $title=" | Cuti Diterima"@endphp</title>

</head>
@auth
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Cuti Diterima</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cuti Diterima
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
                        <div class="card-header text-bg-info">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 style="font-weight: bold" class="card-title">CUTI DITERIMA</h3>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <div class="search-container text-end">
                                <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari data..." style="display: none;">
                                <button id="searchToggle" class="btn btn-success">Search <i class="bi bi-search"></i></button>
                            </div>
                            <br>
                            <table id="myTable" class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">No</th>
                                        <th data-sortable="true">Nama Pekerja</th>
                                        <th data-sortable="true">NIP</th>
                                        <th data-sortable="true">Jabatan</th>
                                        <th data-sortable="true">Unit Kerja</th>
                                        <th data-sortable="true">Masa Kerja</th>
                                        <th data-sortable="true">Jenis Cuti</th>
                                        <th data-sortable="true">Status</th>
                                        <th data-sortable="true">Tanggal Diajukan</th>
                                        <th style="">Selengkapnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        @php $rowNumber = $blanko->firstItem(); @endphp
                                        @foreach ($blanko as $view)
                                        @if ($view->konfirmasi=="diterima")
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
                                        <td>{{ucwords($view->konfirmasi)}}</td>
                                        <td>{{ \Carbon\Carbon::parse($view->created_at)->locale('id')->translatedFormat('d F Y')}}</td>
                                        <td class="text-center">
                                            <a href="{{$view->blanko_diterima}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
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
                                                    </div>
                                                    <p class="d-flex justify-content-between">
                                                        <span>
                                                            <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal <i class="bi bi-file-text-fill"></i></a>
                                                        </span>
                                                        {{-- @if ($role === "super_user" || $role === "admin")
                                                            <a class="btn btn-danger" onclick="confirmDelete({{$view->bid}})">HAPUS <i class="bi bi-trash"></i></a>
                                                        @endif --}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                    {{-- <tr class="text-center">
                                        <td colspan="100">No data available</td>
                                    </tr> --}}
                                    @endif  
                                    </tr>
                                    {{-- @empty
                                    <tr class="text-center">
                                        <td colspan="100">No data available</td>
                                    </tr>
                                    @endforelse --}}
                                    @endforeach
                                </tbody>
                            </table>
                                </div> <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{ $blanko->render('layouts/pagination') }}
                                </div>
      
{{-- ====================================================  SAKIT  ====================================================== --}}
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->
<script>

</script>
@endauth
@endsection