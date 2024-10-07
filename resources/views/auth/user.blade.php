@extends('adminlte.layouts.app')

@section('content')

@auth
<head>
    <title>@php $title=" | ADMIN ONLY | Akun User"@endphp</title>
  </head>

<main class="app-main"> <!--begin::App Content Header-->
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->

            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tabel User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tabel User
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 style="font-weight: bold" class="card-title">Tabel User</h3>
                            <a class="btn btn-info" href="{{url('/admin/create-user')}}">Tambah User <i class="fas fa-user-plus"></i></a>
                        </div> <!-- /.card-header --><div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">#</th>
                                        <th style="">Nama Akun</th>
                                        <th style="">E-mail</th>
                                        <th style="">Hak</th>
                                        <th style="">jabatan</th>
                                        <th style="">Asal</th>
                                        <th style="">Akun dibuat</th>
                                        {{-- <th style="width: 10%">Status</th> --}}
                                        @if ($role === 'admin')
                                        <th style="">ADMIN CONTROL</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        @php $rowNumber = 1; @endphp
                                        @forelse ($userlist as $view)
                                        <td>{{ $rowNumber++ }}</td>
                                        <td>{{ucwords(str_replace('_', ' ', $view->name))}}</td>
                                        <td>{{$view->email}}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $view->role)) }}</td>
                                        <td>{{ strtoupper(format_jabatan($view->jabatan)) }}</td>
                                        <td>{{ucwords($view->asal)}}</td>
                                        <td>{{$view->created_at}}</td>
                                        <td><a class="btn btn-danger" onclick="userDelete({{$view->id}})">HAPUS <i class="bi bi-trash"></i></a></td>
                                        </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="9">No data available</td>
                                            </tr>
                                        @endforelse
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->

@endauth

@endsection