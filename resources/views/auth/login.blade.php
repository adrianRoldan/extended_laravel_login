
@extends('auth.app')

@section('title') Login @endsection

@section('content')

    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-md-9 col-lg-7 col-xl-4 mx-auto">
                    <div class="auth-form-light text-left p-5">

                        <h3>{{ __("Login Welcome") }}</h3>
                        <h6 class="font-weight-light">{{ __("Login Welcome Subtitle") }}</h6>

                        @error('error')
                            <div class="alert alert-danger mt-4">{{ $message }}</div>
                        @enderror

                        <form class="pt-3" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">

                                @error('email')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"  name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="text-danger mt-2" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn text-uppercase">{{ __('Login') }}</button>
                            </div>

                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <hr class="mt-5 mb-4">

                            <div class="mb-2 text-center">
                                <a type="button" class="btn btn-block btn-google " href="{{ route("google.login") }}">
                                    <i class="mdi mdi-google me-2"></i>{{ __('Google Login') }} </a>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> {{ __('No Account') }} <a href="{{ route("register") }}" class="text-primary">{{ __('Register') }}</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
