@extends('adminlte.layouts.app')

@section('content')

@auth
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
                                @if ($role === 'user')
                                <a href="{{ url('doc-pegawai') }}" class="btn btn-primary">Download DOC <i class="bi bi-file-text-fill"></i></a>
                                @endif
                            </div>
                        </div> <!-- /.card-header -->
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
                                        @if ($role === 'admin' || $role === 'super_user')
                                        <th style="width: 10%">Selengkapnya</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        @php $rowNumber = 1; @endphp
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
                                        @if ($role === "super_user" || $role ==="admin")
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
                                                        <p class="d-flex justify-content-between">
                                                            @if ($role === "admin")
                                                                <a class="btn btn-danger" onclick="pegawaiDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
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