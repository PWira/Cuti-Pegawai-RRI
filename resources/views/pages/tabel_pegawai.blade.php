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
                        <div class="card-header">
                            <h3 style="font-weight: bold" class="card-title">Pegawai Terdata</h3>
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
                                        @if ($role === 'admin')
                                        <th style="width: 10%">Kontrol Admin</th>
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
                                        @if ($role === 'admin')
                                        <td>
                                            <a class="btn btn-danger" onclick="pegawaiDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a>
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