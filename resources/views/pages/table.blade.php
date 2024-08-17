@extends('adminlte.layouts.app')

@section('content')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
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
                                            @auth
                                            <tr class="align-middle">
                                                @php $rowNumber = 1; @endphp
                                            @if ($role === 'admin')
                                                @forelse ($admin_blanko as $view)
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
                                                    <a href="{{$view->blanko}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
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
                                                                    <a class="btn btn-primary" href="#">Upload File <i class="bi bi-upload"></i></a>
                                                                    <a class="btn btn-success" href="#">Diterima <i class="bi bi-check"></i></a>
                                                                    <a class="btn btn-danger" href="#">Ditolak <i class="bi bi-x"></i></a>
                                                                </span>
                                                                    <a class="btn btn-danger" onclick="confirmDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
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
                                            @endauth
                                            @else
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
                                                    <a href="{{$view->blanko}}" target="_blank" class="btn btn-primary">View File <i class="bi bi-file-text-fill"></i></a>
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
                                                                    <a class="btn btn-primary" href="#">Upload File <i class="bi bi-upload"></i></a>
                                                                    <a class="btn btn-success" href="#">Diterima <i class="bi bi-check"></i></a>
                                                                    <a class="btn btn-danger" href="#">Ditolak <i class="bi bi-x"></i></a>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                                {{-- <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge text-bg-danger">55%</span></td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>2.</td>
                                                <td>Clean database</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar text-bg-warning" style="width: 70%"></div>
                                                    </div>
                                                </td>
                                                <td> <span class="badge text-bg-warning">70%</span> </td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>3.</td>
                                                <td>Cron job running</td>
                                                <td>
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar text-bg-primary" style="width: 30%"></div>
                                                    </div>
                                                </td>
                                                <td> <span class="badge text-bg-primary">30%</span> </td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td>4.</td>
                                                <td>Fix and squish bugs</td>
                                                <td>
                                                    <div class="progress progress-xs progress-striped active">
                                                        <div class="progress-bar text-bg-success" style="width: 90%"></div>
                                                    </div>
                                                </td>
                                                <td> <span class="badge text-bg-success">90%</span> </td>
                                            </tr> --}}
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div> <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                                        <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                                        <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                                        <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                                        <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
                                    </ul>
                                </div>
                            </div> <!-- /.card -->
                            {{-- @forelse ($blanko as $view)
                            <iframe src="{{ $view->blanko }}" width="100%" height="100%"></iframe>
                            @empty
                                <br>
                            @endforelse --}}
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->
</body><!--end::Body-->

@endsection