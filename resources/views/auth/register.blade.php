@extends('auth.app')

@section('title') Registro @endsection

@section('content')

    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">

                        <h3>{{ __("No Account") }}</h3>
                        <h6 class="font-weight-light">Registrarse es fácil. Solo te tomará unos segundos</h6>

                        @error('error')
                            <div class="alert alert-danger mt-4">{{ $message }}</div>
                        @enderror

                        <form class="pt-3" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name" value="{{ old('name') }}" required class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}">

                                @error('name')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" value="{{ old('email') }}" required class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}">

                                @error('email')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" required class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="password" name="password_confirmation" required class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('Confirm Password') }}">

                                @error('password')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium text-uppercase" >{{ __('Register') }}</button>
                            </div>

                            <hr class="mt-5 mb-4">

                            <div class="mb-2 text-center">
                                <a type="button" class="btn btn-block btn-google " href="{{ route("google.login") }}">
                                    <i class="mdi mdi-google me-2"></i>{{ __('Google Register') }} </a>
                            </div>

                            <div class="text-center mt-4 font-weight-light"> {{ __("Already registered?") }} <a href="{{ route("login") }}" class="text-primary">{{ __('Login') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
