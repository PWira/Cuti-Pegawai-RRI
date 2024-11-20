@extends('adminlte.layouts.app')

@section('content')

<head>
  <title>@php $title=" | ADMIN ONLY | Buat Akun"@endphp</title>
</head>

<body>
  <div class="card card-danger card-outline mb-4" style="margin: 2% 2% 2% 2%">
        <div class="card-header" style="text-align:center;">
            <h3 class="">Register Akun Baru</h3>
        </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <div class="letter-container">
      <form action="{{ route('admin.users.store') }}" method="post">
        @csrf
              <div class="card-body">
                  <div class="row g-2">
                        <div class="">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="contoh@email.com" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nomor Induk Pekerja" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="roles" class="form-label">Roles</label>
                            <select class="form-select" id="roles" name="roles" required onchange="setRole()">
                                <option value="">Roles</option>
                                <option value="admin">Admin</option>
                                <option value="direktur">Direktur</option>
                                <option value="kepala_rri">Kepala Daerah RRI</option>
                                <option value="sdm">SDM</option>
                                {{-- <option value="Pegawai">Pegawai</option> --}}
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="hak" class="form-label">Hak Akses Website</label>
                            <input type="text" class="form-control @error('hak') is-invalid @enderror" id="hak" name="hak" placeholder="Hak akses disesuaikan dengan Roles" value="" readonly required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                            <div class="valid-feedback"></div>
                        </div>
                        {{-- <p></p>
                        <hr class="" style="color: gray">
                        <p>Catatan : Data Pegawai dibawah ini juga digunakan untuk rekapitulasi, pastikan data yang dimasukkan sesuai dengan data yang ada.</p> --}}
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Nama Jabatan Lengkap">
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="unit_kerja" class="form-label">Unit Kerja RRI</label>
                            <select class="form-select form-select-sm" id="unit_kerja" name="user_unit_id" required>
                                <option value="">Pilih Unit Kerja</option>
                                @forelse($unit_kerja as $unit)
                                    <option value="{{ $unit->unit_id }}">{{ $unit->unit_kerja }}</option>
                                @empty
                                <option value="" class="text-danger text-center">Kosong!</option>
                                @endforelse
                            </select>
                            <div class="valid-feedback"></div>
                        </div>
                  </div>
              </div>
              <div class="card-footer" style="text-align: center">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Create User') }}</button>
              </div>
          </form>
      </div>
  </div>
  <script>
      const alasanTextarea = document.getElementById('alasan');
      const alasanHelp = document.getElementById('alasan-help');
      const alasanWarning = document.getElementById('alasan-warning');
  
      alasanTextarea.addEventListener('input', function () {
          const characterCount = alasanTextarea.value.length;
          alasanHelp.textContent = `Maximum 50 characters (${characterCount}/50)`;
  
          if (characterCount > 50) {
              alasanWarning.classList.remove('d-none');
          } else {
              alasanWarning.classList.add('d-none');
          }
      });
  </script>    
</body>
  <script>
    function setRole() {
        var roles = document.getElementById("roles");
        var hak = document.getElementById("hak");

        if(roles.value === "admin"){
          hak.value = "Admin";
        }else if (roles.value === "direktur" || roles.value === "kepala_rri") {
            hak.value = "User";
        } else if (roles.value === "sdm") {
            hak.value = "Super User";
        } else {
            hak.value = "User";
        }
    }
  </script>
@endsection
