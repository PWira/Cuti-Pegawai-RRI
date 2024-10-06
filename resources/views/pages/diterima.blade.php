@extends('adminlte.layouts.app')

@section('content')
<head>
<title>@php $title="Cuti Diterima"@endphp</title>
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
                                @if ($role === 'super_user')
                                <a href="{{ url('pengajuan/diterima') }}" class="btn btn-primary">Download DOC <i class="bi bi-file-text-fill"></i></a>
                                @endif
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
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
                                        <th style="" class="sortable">Tanggal Diajukan</th>
                                        <th style="">Selengkapnya</th>
                                    </tr>
                                </thead>
                                        <tbody>
                                            <tr class="align-middle">
                                                @php $rowNumber = $blanko->firstItem(); @endphp
                                                @foreach ($blanko as $view)
                                                @if ($view->jenis_cuti!="cuti_sakit" && $view->konfirmasi=="diterima")
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
                                                <td>{{ucwords($view->konfirmasi)}}</td>
                                                <td>
                                                    <a href="{{$view->blanko_diterima}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->bid }}" aria-expanded="false" aria-controls="collapse{{ $view->bid }}">
                                                        Selengkapnya <i class="bi bi-arrow-down"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="9">
                                                    <div class="collapse" id="collapse{{ $view->bid }}">
                                                        <div class="card card-body">
                                                            <span class="d-flex justify-content-between">
                                                                <p>Dibuat Oleh: {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }} {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} {{ucwords(str_replace('_', ' ', $view->oleh_asal))}}</p>
                                                            </span>
                                                            <span class="d-flex justify-content-between">
                                                                <p>Diajukan Tanggal: {{ \Carbon\Carbon::parse($view->created_at)->format('d-m-Y') }}</p>
                                                                <p>Mulai Cuti : {{ \Carbon\Carbon::parse($view->mulai_cuti)->format('d-m-Y') }}</p>
                                                                <p>Selesai Cuti : {{ \Carbon\Carbon::parse($view->selesai_cuti)->format('d-m-Y') }}</p>
                                                                <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti)))+1 }} hari</p>
                                                            </span>
                                                            <p>Alasan: {{ $view->alasan }}</p>
                                                            <p class="d-flex justify-content-between">
                                                                <span>
                                                                    <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal <i class="bi bi-file-text-fill"></i></a>
                                                                </span>
                                                                @if ($role === "super_user" || $role === "admin")
                                                                    <a class="btn btn-danger" onclick="confirmDelete({{$view->bid}})">HAPUS <i class="bi bi-trash"></i></a>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            @else
                                            <tr class="text-center">
                                                <td colspan="9">No data available</td>
                                            </tr>
                                            @endif  
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    {{ $blanko->render('layouts/pagination') }}
                                </div>
      
{{-- ====================================================  SAKIT  ====================================================== --}}

                <div class="card mb-4"> <!-- AWALAN TABLE -->
                    <div class="card-header text-bg-info">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 style="font-weight: bold" class="card-title">CUTI SAKIT DITERIMA</h3>
                            {{-- <a href="{{ url('pengajuan/diterima') }}" class="btn btn-primary">Download DOC</a> --}}
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
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
                                    <th style="" class="sortable">Tanggal Diajukan</th>
                                    <th style="">Selengkapnya</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        @php $rowNumber = 1; @endphp
                                        @foreach ($blanko as $view)
                                        @if ($view->jenis_cuti=="cuti_sakit" && $view->konfirmasi=="diterima")
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
                                        <td>{{ucwords($view->konfirmasi)}}</td>
                                        <td>
                                            <a href="{{$view->blanko_diterima}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->bid }}" aria-expanded="false" aria-controls="collapse{{ $view->bid }}">
                                                Selengkapnya <i class="bi bi-arrow-down"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <div class="collapse" id="collapse{{ $view->bid }}">
                                                <div class="card card-body">
                                                    <span class="d-flex justify-content-between">
                                                        <p>Dibuat Oleh: {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }} {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} {{ucwords(str_replace('_', ' ', $view->oleh_asal))}}</p>
                                                    </span>
                                                    <span class="d-flex justify-content-between">
                                                        <p>Diajukan Tanggal: {{ \Carbon\Carbon::parse($view->created_at)->format('d-m-Y') }}</p>
                                                        <p>Mulai Cuti : {{ \Carbon\Carbon::parse($view->mulai_cuti)->format('d-m-Y') }}</p>
                                                        <p>Selesai Cuti : {{ \Carbon\Carbon::parse($view->selesai_cuti)->format('d-m-Y') }}</p>
                                                        <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti)))+1 }} hari</p>
                                                    </span>
                                                    <p>Alasan: {{ $view->alasan }}</p>
                                                    <p class="d-flex justify-content-between">
                                                        <span>
                                                            <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal <i class="bi bi-file-text-fill"></i></a>
                                                        </span>
                                                        @if ($role === "super_user" || $role === "admin")
                                                            <a class="btn btn-danger" onclick="confirmDelete({{$view->bid}})">HAPUS <i class="bi bi-trash"></i></a>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                    <tr class="text-center">
                                        <td colspan="9">No data available</td>
                                    </tr>
                                    @endif  
                                    </tr>
                                    @endforeach    
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
@endauth
@endsection