@extends('layouts.app')
@section('content')

<div class="main">

    <section class="signup">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container-1">
            <div class="signup-content">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" id="signup-form" class="signup-form">
                    @csrf

                    <h2 class="form-title">Reset Password</h2>

                    <div class="form-group">

                        <input id="email" type="email" placeholder="Enter your email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="{{ __('Send Password Reset Link') }}"/>
                    </div>

                </form>

            </div>
        </div>
    </section>

</div>

@endsection
