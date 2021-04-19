@extends('layouts.app')

@section('content')
<div class="container py-5 vh-70">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-4 d-none d-md-flex align-items-center justify-content-center">
              <img src="/images/logo.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-8 d-flex align-items-center">
              <form method="POST" action="{{ route('login', app()->getLocale()) }}" class="w-100">
                @csrf

                <div class="form-group row">
                  <label for="email" class="col-xl-3 col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                  <div class="col-md-8">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-xl-3 col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                  <div class="col-md-8">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6 offset-xl-3 offset-md-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>

                      <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-xl-3 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request', app()->getLocale()) }}">
                      {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
