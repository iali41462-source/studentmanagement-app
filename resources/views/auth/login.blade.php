@extends('layouts.guest')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>SMS Login</h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('login.submit') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                            >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="form-check mb-3">

                            <input
                                type="checkbox"
                                name="remember"
                                class="form-check-input"
                                id="remember"
                            >

                            <label
                                class="form-check-label"
                                for="remember"
                            >
                                Remember Me
                            </label>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>
<hr>

<div class="text-center">
    <p class="mb-0">
        Don't have an account?
        <a href="{{ route('register') }}">
            Register
        </a>
    </p>
</div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
