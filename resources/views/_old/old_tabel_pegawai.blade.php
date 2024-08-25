@extends('adminlte.layouts.app')

@section('content')

@auth
{{-- @foreach ($konfirmasi as $tabel) --}}
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
                            <h3 style="font-weight: bold" class="card-title">Tabel Isi</h3>
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
                                        <th style="width: 10%">Status</th>
                                        {{-- @if($admin_blanko->first() && $admin_blanko->first()->status == 'cuti')
                                            <th style="width: 10%">Masa Cuti</th>
                                        @endif
                                        @if ($role === 'admin')
                                        <th style="width: 10%">Selengkapnya</th>
                                        @endif --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @switch($tabel->status)
                                        @case('aktif')
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
                                                <td>{{$view->status}}</td>
                                                {{-- <td>
                                                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $view->id }}" aria-expanded="false" aria-controls="collapse{{ $view->id }}">
                                                        Selengkapnya <i class="bi bi-arrow-down"></i>
                                                    </button>
                                                </td> --}}
                                                </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="9">No data available</td>
                                                    </tr>
                                                @endforelse
                                        @break
                                    @default
                                        <tr class="text-center">
                                            <td colspan="9">No data available</td>
                                        </tr>
                                    @endswitch
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

@endforeach
@endauth

@endsection