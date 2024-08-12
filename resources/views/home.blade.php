@extends('adminlte.layouts.app')

@section('content')

<main class="app-main"> <!--begin::App Content Header-->
  <div class="app-content-header"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
          <div class="row">
              <div class="col-sm-6">
                  <h3 class="mb-0">Dashboard</h3>
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
      </div> <!--end::Container-->
  </div> <!--end::App Content Header--> <!--begin::App Content-->
  <div class="app-content"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Row-->
          <div class="row"> <!--begin::Col-->
              <div class="col-lg-3 col-5"> <!--begin::Small Box Widget 1-->
                  <div class="small-box text-bg-primary">
                      <div class="inner">
                          <h3>150</h3>
                          <p>Pekerja Aktif</p>
                      </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122z"></path>
                      </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                          Selengkapnya <i class="bi bi-link-45deg"></i> </a>
                  </div> <!--end::Small Box Widget 1-->
              </div> <!--end::Col-->
              <div class="col-lg-3 col-5"> <!--begin::Small Box Widget 2-->
                  <div class="small-box text-bg-info">
                      <div class="inner">
                          <h3>53<!--<sup class="fs-5">%</sup>--></h3>
                          <p>Pekerja Cuti</p>
                      </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M5 4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2H5zm0 2h14v2H5V6zm0 4h14v10H5V10zm7 2a2 2 0 100 4 2 2 0 000-4zm-4 7h8a3 3 0 00-8 0zm-2-9h2v2H6v-2zm4 0h2v2h-2v-2zm-4 4h2v2H6v-2z M17 6.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                      </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                          Selengkapnya <i class="bi bi-link-45deg"></i> </a>
                  </div> <!--end::Small Box Widget 2-->
              </div> <!--end::Col-->
              <div class="col-lg-3 col-5"> <!--begin::Small Box Widget 3-->
                  <div class="small-box text-bg-success">
                      <div class="inner">
                          <h3>44</h3>
                          <p>Cuti Diterima</p>
                      </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                      </svg> <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                          More info <i class="bi bi-link-45deg"></i> </a>
                  </div> <!--end::Small Box Widget 3-->
              </div> <!--end::Col-->
              <div class="col-lg-3 col-5"> <!--begin::Small Box Widget 4-->
                  <div class="small-box text-bg-warning">
                      <div class="inner">
                          <h3>65</h3>
                          <p>Pengajuan Cuti</p>
                      </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M3 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H3zm0 2h18v12H3V6zm2 2v2h14V8H5zm0 4v2h14v-2H5zm0 4v2h14v-2H5z"></path>
                      </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                          More info <i class="bi bi-link-45deg"></i> </a>
                  </div> <!--end::Small Box Widget 4-->
              </div> <!--end::Col-->
              <div class="col-lg-3 col-5"> <!--begin::Small Box Widget 4-->
                  <div class="small-box text-bg-danger">
                      <div class="inner">
                          <h3>65</h3>
                          <p>Cuti Ditolak</p>
                      </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                      </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                          Selengkapnya <i class="bi bi-link-45deg"></i> </a>
                  </div> <!--end::Small Box Widget 4-->
              </div> <!--end::Col-->
          </div> <!--end::Row--> <!--begin::Row-->
          <div class="row"> <!-- Start col -->
              <div class="col-lg-7 connectedSortable">
                  <div class="card mb-4">
                      <div class="card-header">
                          <h3 class="card-title">Sales Value</h3>
                      </div>
                      <div class="card-body">
                          <div id="revenue-chart"></div>
                      </div>
                  </div> <!-- /.card --> <!-- DIRECT CHAT -->
              </div> <!-- /.Start col --> <!-- Start col -->
              <div class="col-lg-5 connectedSortable"> <!-- USERS LIST -->
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Latest Members</h3>
                          <div class="card-tools"> <span class="badge text-bg-danger">
                                  8 New Members
                              </span> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button> </div>
                      </div> <!-- /.card-header -->
                      {{-- <div class="card-body p-0">
                          <div class="row text-center m-1">
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user1-128x128.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      Alexander Pierce
                                  </a>
                                  <div class="fs-8">Today</div>
                              </div>
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user1-128x128.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      Norman
                                  </a>
                                  <div class="fs-8">Yesterday</div>
                              </div>
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user7-128x128.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      Jane
                                  </a>
                                  <div class="fs-8">12 Jan</div>
                              </div>
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user6-128x128.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      John
                                  </a>
                                  <div class="fs-8">12 Jan</div>
                              </div>
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user2-160x160.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      Alexander
                                  </a>
                                  <div class="fs-8">13 Jan</div>
                              </div>
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user5-128x128.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      Sarah
                                  </a>
                                  <div class="fs-8">14 Jan</div>
                              </div>
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user4-128x128.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      Nora
                                  </a>
                                  <div class="fs-8">15 Jan</div>
                              </div>
                              <div class="col-3 p-2"> <img class="img-fluid rounded-circle" src="../../dist/assets/img/user3-128x128.jpg" alt="User Image"> <a class="btn fw-bold fs-7 text-secondary text-truncate w-100 p-0" href="#">
                                      Nadia
                                  </a>
                                  <div class="fs-8">15 Jan</div>
                              </div>
                          </div> <!-- /.users-list -->
                      </div> <!-- /.card-body --> --}}
                      <div class="card-footer text-center"> <a href="javascript:" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View All Users</a> </div> <!-- /.card-footer -->
                  </div> <!-- /.card -->
              </div> <!-- /.col -->
          </div> <!-- /.row (main row) -->
      </div> <!--end::Container-->
  </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->

@endsection
