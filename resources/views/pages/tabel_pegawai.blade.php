@extends('adminlte.layouts.app')

@section('content')

@auth
<head>
    <title>@php $title=" | Tabel Pegawai"@endphp</title>
</head>
<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel Pegawai</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tabel Pengawai
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
                        <div class="card-header text-bg-success">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 style="font-weight: bold" class="card-title">DATA PEGAWAI</h3>
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
                                        <th style="">Nama Pekerja</th>
                                        <th style="">Jenis Kelamin</th>
                                        <th style="width: 2%">Umur</th>
                                        <th style="width: 5%">NIP</th>
                                        <th style="">Jabatan</th>
                                        <th style="">Unit Kerja</th>
                                        <th style="">Masa Kerja</th>
                                        <th style="">Selengkapnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        @php $rowNumber = $blanko->firstItem(); @endphp
                                        @forelse ($blanko as $view)
                                        <td>{{ $rowNumber++ }}</td>
                                        <td>{{$view->nama}}</td>
                                        <td>{{ format_jk($view->jk) }}</td>
                                        <td>{{$view->umur}}</td>
                                        <td>{{$view->nip}}</td>
                                        <td>{{ format_jabatan($view->jabatan) }}</td>
                                        <td>{{ucwords($view->unit_kerja)}}</td>
                                        <td>
                                            @php
                                                $years = floor($view->masa_kerja / 12);
                                                $months = $view->masa_kerja % 12;
                                            @endphp
                                            {{ $years }} tahun {{ $months }} bulan
                                        </td>
                                        @if ($roles === "sdm" || $roles ==="admin")
                                            <td>
                                                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->pid }}" aria-expanded="false" aria-controls="collapse{{ $view->pid }}">
                                                    Selengkapnya <i class="bi bi-arrow-down"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="100">
                                                <div class="collapse" id="collapse{{ $view->pid }}">
                                                    <div class="card card-body">
                                                            <p>Dibuat Oleh: {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }} 
                                                            <br>Jabatan : {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} 
                                                            <br>NIP : {{ucwords(str_replace('_', ' ', $view->oleh_nip))}}</p>
                                                        <p class="d-flex justify-content-between">
                                                            @if ($roles === "sdm")
                                                                <a href="{{ route('edit-pegawai', $view->pid) }}" class="btn btn-primary">Edit</a>
                                                                <a class="btn btn-danger" onclick="pegawaiDelete({{$view->pid}})">HAPUS <i class="bi bi-trash"></i></a>
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
@endauth

@endsection