@extends('layouts.frontapp')

@section('title','login')
@section('frontPageContent')

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="register_header text-center">
            <h4 class="text-danger py-3">Login</h4>
          </div> 

        <div class="register_wrap tab-content">
            <div class="tab-pane show active" id="signin_tab" role="tabpanel">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form_item_wrap">
                        <h3 class="input_title">User Name*</h3>
                        <div class="form_item">
                            <label for="username_input"><i class="fas fa-user"></i></label>
                            <input id="username_input" type="text" name="username" placeholder="User Name">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">Password*</h3>
                        <div class="form_item">
                            <label for="password_input"><i class="fas fa-lock"></i></label>
                            <input id="password_input" type="password" name="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="checkbox_item">               
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember_checkbox">Remember Me</label>
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <button type="submit" class="btn btn_primary">Sign In</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

{{-- 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
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
@endsection --}}
