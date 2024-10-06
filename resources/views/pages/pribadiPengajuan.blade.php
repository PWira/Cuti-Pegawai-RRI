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
                                <a href="{{ url('pengajuan/semua') }}" class="btn btn-primary">Download DOC <i class="bi bi-file-text-fill"></i></a>
                                @endif
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">#</th>
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
                                            <td>
                                                <p>{{ \Carbon\Carbon::parse($view->created_at)->format('d-m-Y') }}</p>
                                            </td>
                                            <td>
                                                <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-primary">Blanko<i class="bi bi-file-text-fill"></i></a>
                                                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->bid }}" aria-expanded="false" aria-controls="collapse{{ $view->bid }}" class="btn btn-secondary">Detail <i class="bi bi-arrow-down"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12">
                                                <div class="collapse" id="collapse{{ $view->bid }}">
                                                    <div class="card card-body">
                                                        <span class="d-flex justify-content-between">
                                                            <p>Dibuat Oleh: {{ ucwords(str_replace('_', ' ', $view->oleh_user)) }} {{strtoupper(str_replace('_', ' ', $view->oleh_jabatan))}} {{ucwords(str_replace('_', ' ', $view->oleh_asal))}}</p>
                                                        </span>
                                                        <span class="d-flex justify-content-between">
                                                            <p>Mulai Cuti : {{ \Carbon\Carbon::parse($view->mulai_cuti)->format('d-m-Y') }}</p>
                                                            <p>Selesai Cuti : {{ \Carbon\Carbon::parse($view->selesai_cuti)->format('d-m-Y') }}</p>
                                                            <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti)))+1 }} hari</p>
                                                        </span>
                                                        <p>Alasan: {{ $view->alasan }}</p>
                                                        <span class="d-flex justify-content-between">
                                                        <a href="{{$view->blanko_ditangguhkan}}" target="_blank" class="btn btn-secondary">Lihat Blanko Pengajuan Awal<i class="bi bi-file-text-fill"></i></a>
                                                        @if($cekstatus =="ditangguhkan")
                                                            <a class="btn btn-danger" onclick="confirmDeletePersonal({{$view->bid}})">HAPUS <i class="bi bi-trash"></i></a>
                                                        @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                        </tr>
                                        @empty
                                    <tr class="text-center">
                                        <td colspan="12">No data available</td>
                                    </tr>
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
@endauth
@endsection