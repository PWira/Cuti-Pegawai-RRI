@extends('adminlte.layouts.app')

@section('content')

<body class="register-page bg-body-secondary">
    <div class="card card-outline card-primary" style="margin: auto; width: 500px;">
          {{-- <div class="card-header"> <a href="{{ route('home') }}" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                  <h1 class="mb-0"> <b>{{ config('app.name', 'Laravel') }}</b>
                  </h1>
              </a> 
            </div> --}}
        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Register Akun Baru</p>

            <form action="{{ route('admin.users.store') }}" method="post">
              @csrf
              <div class="input-group mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full name" name="name" value="{{ old('name') }}">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" name="email" value="{{ old('email') }}">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="input-group mb-3">
                <select class="form-select" id="asal" name="asal" required>
                  <option value="">Unit Kerja</option>
                  <option value="admin">Admin</option>
                  <option value="jakarta">Jakarta</option>
                  <option value="palembang">Palembang</option>
                </select>
              </div>
              <div class="input-group mb-3">
                <select class="form-select" id="jabatan" name="jabatan" required onchange="setRole()">
                    <option value="">Jabatan</option>
                    <option value="admin">Admin</option>
                    <option value="direktur">Direktur</option>
                    <option value="kepala_rri">Kepala Daerah RRI</option>
                    <option value="sdm">SDM</option>
                    {{-- <option value="Pegawai">Pegawai</option> --}}
                </select>
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" placeholder="Hak Akses Website" value="" readonly required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-key"></span>
                    </div>
                  </div>
              </div>
              {{-- <div class="input-group mb-3">
                  <select class="form-select" id="role" name="role" required @readonly(true) readonly>
                      <option value="">Hak Akses Website</option>
                      <option value="superuser">Super User</option>
                      <option value="user">User</option>
                  </select>
              </div> --}}
              <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
                <div class="mb-3 text-center">
                  <button type="submit" class="btn btn-primary btn-block">{{ __('Create User') }}</button>
                </div>
            </form>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
    </div>
</body>
  <script>
    function setRole() {
        var jabatan = document.getElementById("jabatan");
        var role = document.getElementById("role");

        if(jabatan.value === "admin"){
          role.value = "Admin";
        }else if (jabatan.value === "direktur" || jabatan.value === "kepala_rri") {
            role.value = "Super User";
        } else if (jabatan.value === "sdm") {
            role.value = "User";
        } else {
            role.value = "User";
        }
    }
  </script>
@endsection