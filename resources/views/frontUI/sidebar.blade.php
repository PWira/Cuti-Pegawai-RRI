@auth
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{url('/')}}" class="brand-link"> <!--begin::Brand Image--> <img src="{{ asset('/assets/img/XmarkWhiteCircle.png') }}" alt="AdminLTE Logo" class="brand-image opacity-100 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">Cuti Kantor</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="{{url('/')}}" class="nav-link"> <i class="nav-icon bi bi-speedometer2"></i>
                    <p>Dashboard</p>
                </a> 
                </li>  
                @if ($role==='admin')
                <hr style="color: aliceblue">
                <li class="nav-item"> <a href="#" class="nav-link"><i class="nav-icon fas fa-user-secret"></i>
                    <p class="text-danger">
                        ADMIN ONLY
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p></a>    
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{url('/admin/user')}}" class="nav-link"> <i class="nav-icon fa fa-user"></i>
                            <p>User</p>
                        </a> </li>
                    </ul>
                </li>
                @endif
                <hr class="" style="color: aliceblue">
                @if ($role ==='super_user')
                <li class="nav-item"> <a href="{{url('data-pegawai')}}" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Isi Data Pegawai</p>
                </a> </li> 
                @endif
                <li class="nav-item"> <a href="#" class="nav-link"><i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        Data Pegawai
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p></a>    
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{url('pegawai')}}" class="nav-link"> <i class="nav-icon bi bi-table text-success"></i>
                            <p>Pegawai</p>
                        </a> 
                        </li>   
                    </ul>
                </li>
                <hr style="color: aliceblue">
                @if ($role ==='super_user')
                <li class="nav-item"> <a href="{{url('form')}}" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Form Pengajuan</p>
                </a> </li>
                <li class="nav-item"> <a href="{{url('pengajuan-anda')}}" class="nav-link"> <i class="nav-icon bi bi-table"></i>
                    <p>Pengajuan Anda</p>
                    </a> 
                </li>   
                @endif
                <li class="nav-item"> <a href="#" class="nav-link"><i class="nav-icon bi bi-file-text"></i>
                    <p>
                        Pengajuan
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p></a>    
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{url('table-pengajuan')}}" class="nav-link"> <i class="nav-icon bi bi-table text-warning"></i>
                                <p>Pengajuan Cuti</p>
                            </a> 
                        </li>   
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{url('table-diterima')}}" class="nav-link"> <i class="nav-icon bi bi-table text-info"></i>
                                <p>Cuti Diterima</p>
                            </a> 
                        </li>   
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{url('table-ditolak')}}" class="nav-link"> <i class="nav-icon bi bi-table text-danger"></i>
                                <p>Cuti Ditolak</p>
                            </a> 
                        </li>   
                    </ul>
                    {{-- <hr style="color: aliceblue">
                    <li class="nav-item"> <a href="{{url('form')}}" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                        <p>Test Form Baru</p>
                    </a> </li> --}}
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
@endauth