
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
                        <h3 class="input_title">Name*</h3>
                        <div class="form_item">
                            <label for="username_input2"><i class="fas fa-user"></i></label>
                            <input id="username_input2" class="@error('name')
                               is-invalid 
                            @enderror" type="text" name="name" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                           @enderror
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">User Name*</h3>
                        <div class="form_item">
                            <label for="username_input2"><i class="fas fa-user"></i></label>
                            <input id="username_input2" class="@error('username')
                               is-invalid 
                            @enderror" type="text" name="username" placeholder="User Name">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                           @enderror
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">Email*</h3>
                        <div class="form_item">
                            <label for="email_input"><i class="fas fa-envelope"></i></label>
                            <input id="email_input" type="email" name="email" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                           @enderror
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">Password*</h3>
                        <div class="form_item">
                            <label for="password_input2"><i class="fas fa-lock"></i></label>
                            <input id="password_input2" type="password" name="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                           @enderror
                        </div>
                    </div>

                    <div class="form_item_wrap">
                        <h3 class="input_title">Confirm Password</h3>
                        <div class="form_item">
                            <label for="password_input2"><i class="fas fa-lock"></i></label>
                            <input id="password_input2" type="password" name="password_confirmation" placeholder="Password">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                           @enderror
                        </div>
                    </div>

                     

                    <div class="form_item_wrap">
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

