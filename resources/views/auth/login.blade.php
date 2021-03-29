@extends('layouts.app')
@section('script')
    {{--<script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>--}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
@section('content')
<div class="main">

    <section class="signup">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container-1">
            <div class="signup-content">
                <form method="POST" action="{{ route('login') }}" id="signup-form" class="signup-form">
                    @csrf
                        <h3 class="form-title">
                            <img src="{{asset('images/logo_faucet.jpg')}}" style="width: 70px; height: 70px;">
                            Login to AUWSSC
                        </h3>
                    <div class="form-group">
                        <input id="email" type="email" placeholder="Enter your email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">

                        <input id="password" type="password" placeholder="password" class="form-input  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row mb-0 d-flex">
                        <div class="col-md-12">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="label-agree-term">
                              <span></span>{{ __('Remember Me') }}
                            </label>

                    </div>

                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Login In"/>
                    </div>

                </form>

            </div>
        </div>
    </section>

</div>
@endsection
