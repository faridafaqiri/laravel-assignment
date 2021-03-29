@extends('layouts.app')
@section('content')

<div class="main">
    <section class="signup">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container-1">
            <div class="signup-content">
                <form method="POST" action="{{ route('password.update') }}" id="signup-form" class="signup-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <h2 class="form-title">{{ __('Reset Password') }}</h2>
                    <div class="form-group">
                        <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <input id="password" type="password" placeholder="Enter your password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-input" name="password_confirmation" placeholder="Repeat your password" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="{{ __('Reset Password') }}"/>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection
