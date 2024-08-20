@extends('adminlte.layouts.app')

@section('content')

@auth
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
                        @forelse ($konfirmasi as $tabel)
                            @switch($tabel->status)
                                @case('aktif')
                                    <div class="card-header">
                                        <h3 style="font-weight: bold" class="card-title">Pegawai Aktif</h3>
                                    </div> <!-- /.card-header -->
                                    @break
                                @case('cuti')
                                    <div class="card-header">
                                        <h3 style="font-weight: bold" class="card-title">Pegawai Cuti</h3>
                                    </div> <!-- /.card-header -->
                                    @break
                                @default
                                    <div class="card-header">
                                        <h3 style="font-weight: bold" class="card-title">Tabel Isi</h3>
                                    </div> <!-- /.card-header -->
                            @endswitch
                        @empty
                        <div class="card-header">
                            <h3 style="font-weight: bold" class="card-title">Tabel Isi</h3>
                        </div> <!-- /.card-header -->
                        @endforelse
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">#</th>
                                        <th style="width: 20%">Nama Pekerja</th>
                                        <th style="width: 8%">NIP</th>
                                        <th style="width: 10%">Jabatan</th>
                                        <th style="width: 10%">Unit Kerja</th>
                                        <th style="width: 15%">Masa Kerja</th>
                                        <th style="width: 10%">Status</th>
                                        @if($admin_blanko->first() && $admin_blanko->first()->status == 'cuti')
                                            <th style="width: 10%">Masa Cuti</th>
                                        @endif
                                        @if ($role === 'admin')
                                        <th style="width: 10%">Selengkapnya</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($konfirmasi as $halaman)
                                    @switch($halaman->status)
                                        @case('aktif')
                                            <tr class="align-middle">
                                                @php $rowNumber = 1; @endphp
                                            @if ($role === 'admin')
                                                @forelse ($admin_blanko as $view)
                                                <td>{{ $rowNumber++ }}</td>
                                                <td>{{$view->nama}}</td>
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
                                                <td>{{$view->status}}</td>
                                                <td>
                                                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->id }}" aria-expanded="false" aria-controls="collapse{{ $view->id }}">
                                                        Selengkapnya <i class="bi bi-arrow-down"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td colspan="9">
                                                    <div class="collapse" id="collapse{{ $view->id }}">
                                                        <div class="card card-body">
                                                            <p>Mulai Cuti: {{ $view->mulai_cuti }}</p>
                                                            <p>Selesai Cuti: {{ $view->selesai_cuti }}</p>
                                                            <p>Lamanya Cuti: {{ abs(\Carbon\Carbon::parse($view->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($view->mulai_cuti))) }} hari</p>
                                                            <p>Alasan: {{ $view->alasan }}</p>
                                                            <p class="d-flex justify-content-between">
                                                                <span>
                                                                    <input type="file" class="form-control" id="blanko" name="blanko" accept="application/pdf" required style="display: none;">
                                                                    <a class="btn btn-primary" href="#" onclick="document.getElementById('blanko').click(); return false;">Upload File <i class="bi bi-upload"></i></a>
                                                                    <a class="btn btn-success" href="#">Diterima <i class="bi bi-check"></i></a>
                                                                    <a class="btn btn-danger" href="#">Ditolak <i class="bi bi-x"></i></a>
                                                                </span>
                                                                    <a class="btn btn-danger" onclick="confirmDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
                                                            </p>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr> --}}
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="9">No data available</td>
                                                    </tr>
                                                @endforelse
                                            @else
                                                @forelse ($blanko as $view)
                                                <td>{{ $rowNumber++ }}</td>
                                                <td>{{$view->nama}}</td>
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
                                                <td>{{$view->status}}</td>
                                            </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @endforelse
                                            @endif
                                        @break
                                        @case('cuti')
                                            <tr class="align-middle">
                                                @php $rowNumber = 1; @endphp
                                            @if ($role === 'admin')
                                                @forelse ($admin_blanko as $view)
                                                <td>{{ $rowNumber++ }}</td>
                                                <td>{{$view->nama}}</td>
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
                                                <td>{{$view->status}}</td>
                                                @if ($view->status=='cuti')
                                                <td>{{$view->cuti_hari}}</td>
                                                @else
                                                @endif
                                            </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @endforelse
                                            @else
                                                @forelse ($blanko as $view)
                                                <td>{{ $rowNumber++ }}</td>
                                                <td>{{$view->nama}}</td>
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
                                                <td>{{$view->status}}</td>
                                                @if ($view->status=='cuti')
                                                <td>{{$view->cuti_hari}}</td>
                                                @else
                                                @endif
                                            </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @endforelse
                                            @endif
                                        @break
                                    @default
                                        <tr class="text-center">
                                            <td colspan="9">No data available</td>
                                        </tr>
                                    @endswitch
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="9">No data available</td>
                                        </tr>
                                    @endforelse
                                    @endauth
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $admin_blanko->render('layouts/pagination') }}
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

@endsection