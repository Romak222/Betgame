@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="card card-outline card-primary">

    <div class="card-header text-center">
        <h3 class="mb-0">
            <strong>Indian Classic</strong>
        </h3>

        <p class="text-muted mb-0">
            Retailer Management System
        </p>
    </div>

    <div class="card-body">

        @include('partials.messages')

        <form action="{{ route('login.submit') }}"
              method="POST">

            @csrf

            {{-- Login ID / Username --}}
            <div class="input-group mb-3">

                <input type="text"
                       name="login"
                       class="form-control @error('login') is-invalid @enderror"
                       placeholder="Login ID / Username"
                       value="{{ old('login') }}"
                       autofocus>

                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>

            </div>

            {{-- Password --}}
            <div class="input-group mb-3">

                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password">

                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>

            </div>

            {{-- Remember Me --}}
            <div class="row">

                <div class="col-6">

                    <div class="form-check">

                        <input class="form-check-input"
                               type="checkbox"
                               name="remember"
                               id="remember"
                               value="1"
                               {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label"
                               for="remember">

                            Remember Me

                        </label>

                    </div>

                </div>

                <div class="col-6">

                    <button type="submit"
                            class="btn btn-primary w-100">

                        <i class="fas fa-sign-in-alt"></i>

                        Sign In

                    </button>

                </div>

            </div>

        </form>

        <hr>

        <div class="text-center">

            <a href="#"
               class="text-decoration-none">

                Forgot Password?

            </a>

        </div>

    </div>

</div>

@endsection