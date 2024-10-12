@extends('adminlte.layouts.app')

@section('content')

<head>
    <title>@php $title=" | Dashboard"@endphp</title>
    <style>
        @font-face {
            font-family: 'Times New Roman PS MT';
            src: url('{{ asset('assets/plugins/fonts/TimesNewRomanPSMT_ig.woff') }}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        .welcome-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-family: 'Times New Roman PS MT', serif;
        }

        .welcome-text {
            font-size: 4.5rem;
            font-weight: bold;
            margin-bottom: 0;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            border-right: 2px solid;
            animation: typing 2s steps(20) forwards;
        }

        @keyframes typing {
            0% {
                width: 0;
                border-right-color: black;
            }
            99% {
                width: 99%;
                border-right-color: black;
            }
            100% {
                width: 100%;
                border-right-color: transparent;
            }
        }



        .user-name {
            color: red;
        }
    </style>
</head>

<main class="app-main"> <!--begin::App Content Header-->
  <div class="app-content-header"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0" style="">Dashboard</h3>
                <!-- Add the welcome card here -->
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-end">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                          Dashboard
                      </li>
                  </ol>
              </div>
            </div> <!--end::Row-->
            <div class="welcome-card">
                <div class="welcome-text">Selamat Datang, <span class="user-name">{{ $name }}</span></div>
            </div>
      </div> <!--end::Container-->
  </div> <!--end::App Content Header--> <!--begin::App Content-->
  <div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-lg-6 col-5"> <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $pegawai->first()->total ?? 0 }}</h3>
                        {{-- <h3>{{ $pegawai ?? 0 }}</h3> --}}
                        <p>Jumlah Pegawai</p>
                    </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122z"></path>
                      </svg> <a href="{{url('pegawai')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                          Selengkapnya <i class="bi bi-link-45deg"></i> </a>
                  </div> <!--end::Small Box Widget 1-->
              </div> <!--end::Col-->
                <div class="col-lg-6 col-5"> <!--begin::Small Box Widget 4-->
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $surat->whereIn('konfirmasi', ['ditangguhkan', 'sakit'])->sum('total') ?? 0}}</h3>
                        {{-- <h3>{{ $surat ?? 0}}</h3> --}}
                        <p>Pengajuan Cuti</p>
                        </div> 
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M3 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H3zm0 2h18v12H3V6zm2 2v2h14V8H5zm0 4v2h14v-2H5zm0 4v2h14v-2H5z"></path>
                    </svg> <a href="{{url('table-pengajuan')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Selengkapnya <i class="bi bi-link-45deg"></i> </a>
                    </div> <!--end::Small Box Widget 4-->
                </div> <!--end::Col-->
              <div class="col-lg-6 col-5"> <!--begin::Small Box Widget 3-->
                <div class="small-box text-bg-info">
                    <div class="inner">
                            <h3>{{ $surat->whereIn('konfirmasi', ['diterima', 'sakit'])->sum('total') ?? 0}}</h3>
                            {{-- <h3>{{ $surat ?? 0}}</h3> --}}
                            <p>Cuti Diterima</p>
                        </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"></path>
                      </svg> <a href="{{url('table-diterima')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                          Selengkapnya <i class="bi bi-link-45deg"></i> </a>
                  </div> <!--end::Small Box Widget 3-->
              </div> <!--end::Col-->
              <div class="col-lg-6 col-5"> <!--begin::Small Box Widget 5-->
                  <div class="small-box text-bg-danger">
                      <div class="inner">
                          <h3>{{ $surat->whereIn('konfirmasi', ['ditolak', 'sakit'])->sum('total') ?? 0}}</h3>
                          {{-- <h3>{{ $surat ?? 0 }}</h3> --}}
                          <p>Cuti Ditolak</p>
                      </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                      </svg> <a href="{{url('table-ditolak')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                          Selengkapnya <i class="bi bi-link-45deg"></i> </a>
                        </div> <!--end::Small Box Widget 4-->
                    </div> <!--end::Col-->
                </div> <!--end::Row--> <!--begin::Row-->
            </div> <!-- /.row (main row) -->
      </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->

@endsection
