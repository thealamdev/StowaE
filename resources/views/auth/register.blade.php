
@extends('layouts.frontapp')

@section('title','register')
@section('frontPageContent')

<div class="row justify-content-center">
    <div class="col-lg-8">

       <div class="register_header text-center">
         <h4 class="text-danger py-3">Register</h4>
       </div>

        <div class="register_wrap pt-4">
          
            <div class="tab-pane" id="signup_tab" role="tabpanel">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form_item_wrap">
                        <h3 class="input_title">User Name*</h3>
                        <div class="form_item">
                            <label for="username_input2"><i class="fas fa-user"></i></label>
                            <input id="username_input2" type="text" name="name" placeholder="User Name">
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">Password*</h3>
                        <div class="form_item">
                            <label for="password_input2"><i class="fas fa-lock"></i></label>
                            <input id="password_input2" type="password" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">Confirm Password</h3>
                        <div class="form_item">
                            <label for="password_input2"><i class="fas fa-lock"></i></label>
                            <input id="password_input2" type="password" name="password_confirmation" placeholder="Password">
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">Email*</h3>
                        <div class="form_item">
                            <label for="email_input"><i class="fas fa-envelope"></i></label>
                            <input id="email_input" type="email" name="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        {{-- <button type="submit" class="btn btn_secondary">Register</button> --}}
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
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
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
