@extends('layouts.auth')
@section('title', 'Login')
@section('auth_login_active', 'active')

@section('content')
    <!-- Register -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="{{ URL::asset('assets/img/logo/myoptima.png') }}" width="5%" alt="Logo">
                </span>
            </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Selamat Datang di MyOptima</h4>
            <p class="mb-4">Mari beraktifitas dan semangat setiap harinya</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('auth.login-post') }}" method="post">
                @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter your email or username"
                autofocus
                />
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                </a>
                </div>
                <div class="input-group input-group-merge">
                <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
            </form>

            {{-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="auth-register-basic.html">
                <span>Create an account</span>
            </a>
            </p> --}}
        </div>
    </div>
    <!-- /Register -->
</div>
@endsection