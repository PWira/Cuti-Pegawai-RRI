@extends('adminlte.layouts.app')

@section('content')

<head>
    <title>@php $title=" | Dashboard"@endphp</title>
    <link rel="manifest" href="{{ asset('/assets/img/favicon/site.webmanifest')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/addOn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
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
            {{-- <div class="welcome-card">
                <div class="welcome-text">Selamat Datang, <span class="user-name">{{ $name }}</span></div>
            </div> --}}
      </div> <!--end::Container-->
  </div> <!--end::App Content Header--> <!--begin::App Content-->
  <div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Chart Cuti Diterima</h5>
                        <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
                            {{-- <div class="btn-group"> <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown"> <i class="bi bi-wrench"></i> </button>
                                <div class="dropdown-menu dropdown-menu-end" role="menu"> <a href="#" class="dropdown-item">Action</a> <a href="#" class="dropdown-item">Another action</a> <a href="#" class="dropdown-item">
                                        Something else here
                                    </a> <a class="dropdown-divider"></a> <a href="#" class="dropdown-item">Separated link</a> </div>
                            </div> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button> --}}
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body"> <!--begin::Row-->
                        <div class="row">
                            <div class="">
                                <p id="date-range-title" class="text-center"> <strong>Daftar dari : Jan, 2024 - Des, 2024</strong> </p>
                                <div class="d-flex align-items-center">
                                <button id="filter-toggle" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                
                                <!-- Form Filter -->
                                <form id="filter-form" class="" style="display: none;">
                                    <label for="from-month">Dari Bulan:</label>
                                    <input type="month" id="from-month" name="from-month">
                            
                                    <label for="to-month">Sampai Bulan:</label>
                                    <input type="month" id="to-month" name="to-month">
                            
                                    <button type="button" onclick="updateChart()">Filter</button>
                                </form>
                                </div>
                                <div id="sales-chart"></div>
                            </div> <!-- /.col -->
                        </div> <!--end::Row-->
                    </div> <!-- ./card-body -->
                    <div class="card-footer"> <!--begin::Row-->
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    {{-- <span class="text-success"> <i class="bi bi-caret-up-fill"></i> 17% </span> --}}
                                    <h5 class="fw-bold mb-0">{{ $totalCutiTahunIni }}</h5>
                                    <span class="text-uppercase">TOTAL CUTI TAHUN INI</span>
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center">
                                    {{-- <span class="text-danger"> <i class="bi bi-caret-down-fill"></i> 18% </span> --}}
                                    <h5 class="fw-bold mb-0">{{ $cutiDiterimaTahunIni }}</h5>
                                    <span class="text-uppercase">CUTI DITERIMA TAHUN INI</span>
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    {{-- <span class="text-info"> <i class="bi bi-caret-left-fill"></i> 0% </span> --}}
                                    <h5 class="fw-bold mb-0">{{ $totalCutiBulanIni }}</h5>
                                    <span class="text-uppercase">TOTAL CUTI BULAN INI</span>
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    {{-- <span class="text-success"> <i class="bi bi-caret-up-fill"></i> 20% </span> --}}
                                    <h5 class="fw-bold mb-0">{{ $cutiDiterimaBulanIni }}</h5>
                                    <span class="text-uppercase">CUTI DITERIMA BULAN INI</span>
                                </div>
                            </div> <!-- /.col -->
                        </div> <!--end::Row-->
                    </div> <!-- /.card-footer -->
                </div> <!-- /.card -->
            </div> <!-- /.col -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Pegawai Yang Cuti</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <div id="visitors-chart"></div>
                        </div>
                        {{-- <div class="d-flex flex-row justify-content-end"> <span class="me-2"> <i class="bi bi-square-fill text-primary"></i> Bulan Ini
                            </span> <span> <i class="bi bi-square-fill text-secondary"></i> Bulan Kemarin
                            </span> </div> --}}
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Pegawai Cuti Bulan Ini</h5>
                        <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
                            {{-- <div class="btn-group"> <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown"> <i class="bi bi-wrench"></i> </button>
                                <div class="dropdown-menu dropdown-menu-end" role="menu"> <a href="#" class="dropdown-item">Action</a> <a href="#" class="dropdown-item">Another action</a> <a href="#" class="dropdown-item">
                                        Something else here
                                    </a> <a class="dropdown-divider"></a> <a href="#" class="dropdown-item">Separated link</a> </div>
                            </div> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button> --}}
                        </div>
                    </div> <!-- /.card-header -->
                    <div class="card-body">
                        <div class="">
                                <div id="pie-chart"></div>
                            </div> <!-- /.col -->
                    </div>
                    <div class="card-footer"> <!--begin::Row-->
                        {{-- <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    <h5 class="fw-bold mb-0">{{ $totalCutiTahunIni }}</h5>
                                    <span class="text-uppercase">TOTAL CUTI TAHUN INI</span>
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center">
                                    <h5 class="fw-bold mb-0">{{ $cutiDiterimaTahunIni }}</h5>
                                    <span class="text-uppercase">CUTI DITERIMA TAHUN INI</span>
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    <h5 class="fw-bold mb-0">{{ $totalCutiBulanIni }}</h5>
                                    <span class="text-uppercase">TOTAL CUTI BULAN INI</span>
                                </div>
                            </div> <!-- /.col -->
                            <div class="col-md-3 col-6">
                                <div class="text-center border-end">
                                    <h5 class="fw-bold mb-0">{{ $cutiDiterimaBulanIni }}</h5>
                                    <span class="text-uppercase">CUTI DITERIMA BULAN INI</span>
                                </div>
                            </div> <!-- /.col -->
                        </div> <!--end::Row--> --}}
                    </div> <!-- /.card-footer -->
                </div> <!-- /.card -->
            </div> <!-- /.col -->
            <div class=" d-flex justify-content-between"> <!-- Info Boxes Style 2 -->
                <div class="small-box mb-3 text-bg-success flex-grow-1 me-2">
                    <div class="inner">
                        <h3>{{ $jumlahPegawai }}</h3>
                        <p>Jumlah Pegawai</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122z"></path>
                    </svg>
                    <a href="{{ url('pegawai') }}" class="small-box-footer link-light">Selengkapnya</a>
                </div>
                <div class="small-box mb-3 text-bg-warning flex-grow-1 me-2">
                    <div class="inner">
                        <h3>{{ $jumlahPengajuan }}</h3>
                        <p>Pengajuan Cuti</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M3 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H3zm0 2h18v12H3V6zm2 2v2h14V8H5zm0 4v2h14v-2H5zm0 4v2h14v-2H5z"></path>
                    </svg>
                    <a href="{{ url('table-pengajuan') }}" class="small-box-footer link-light">Selengkapnya</a>
                </div>
                <div class="small-box mb-3 text-bg-info flex-grow-1 me-2">
                    <div class="inner">
                        <h3>{{ $cutiDiterima }}</h3>
                        <p>Cuti Diterima</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"></path>
                    </svg>
                    <a href="{{ url('table-diterima') }}" class="small-box-footer link-light">Selengkapnya</a>
                </div>
                <div class="small-box mb-3 text-bg-danger flex-grow-1">
                    <div class="inner">
                        <h3>{{ $cutiDitolak }}</h3>
                        <p>Cuti Ditolak</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                    </svg>
                    <a href="{{ url('table-ditolak') }}" class="small-box-footer link-light">Selengkapnya</a>
                </div>
                
            </div> <!-- /.col -->
      </div> <!--end::Container-->
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->

<script>
    var dataCuti = @json($dataCuti);
    var jabatanCuti = @json($jabatanCuti);
</script>

@endsection
