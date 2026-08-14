@extends('layouts.guest')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('register.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Register
                        </button>

                    </form>

                    <hr>

                    <div class="text-center">
                        Already have an account?
                        <a href="{{ route('login') }}">
                            Login
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
