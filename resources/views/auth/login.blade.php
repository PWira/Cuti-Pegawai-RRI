@extends('adminlte.layouts.auth')

@section('content')

<head>
    <title>@php $title=" | Login"@endphp</title>
</head>

{{-- <head>
  <title>@php $title=" | Login"@endphp</title>
  <style>
      body, html {
          height: 100%;
          margin: 0;
          padding: 0;
          overflow: hidden;
      }
      .bg-login {
          height: 100vh;
          width: 100vw;
          position: fixed;
          top: 0;
          left: 0;
          z-index: -1;
          overflow: hidden;
      }
      .scrolling-background {
          position: absolute;
          top: 0;
          left: 0;
          width: 300%;
          height: 100%;
          background-image: url("{{ asset('/assets/img/rri-logo-3.png') }}");
          background-repeat: space;
          background-size: auto 80%;
          background-position: center;
          opacity: 0.3;
          animation: scrollBackground 30s linear infinite;
      }
      @keyframes scrollBackground {
          0% {
              transform: translateX(0);
          }
          100% {
              transform: translateX(-33.33%); /* Adjusted for new width */
          }
      }
  </style>
</head> --}}

<body class="login-page bg-body-secondary bg-login">
  <div class="scrolling-background"></div>
  <div class="login-box">
      <div class="card card-outline card-primary">
          <div class="card-header"> <a href="{{ route('home') }}" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                  <h1 class="mb-0"> <b>{{ config('app.name', 'Laravel') }}
                  </b>
                  </h1>
              </a> 
          </div>
      <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Login Untuk Masuk</p>

            <form action="{{ route('login') }}" method="post">
              @csrf
              <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
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
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <!-- /.social-auth-links -->
            {{-- @if (Route::has('password.request'))
            <p class="mb-1">
              <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </p>
            @endif --}}
            {{-- @if (Route::has('register'))
            <p class="mb-0">
              <a href="{{ route('register') }}" class="text-center">{{ __('Register') }}</a>
            </p>
            @endif --}}
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
  </div>
    <!-- /.login-box -->
@endsection
