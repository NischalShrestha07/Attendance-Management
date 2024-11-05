@extends('layouts.auth-layout')

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center"
    style="min-height: 100vh; background-image: url('/images/background.jpg'); background-size: cover;">
    <div class="row justify-content-center w-100">
        <div class="col-md-6">
            <div class="card shadow-lg" style="border-radius: 15px;">
                <div class="card-header text-center bg-primary text-white"
                    style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <!-- Project Branding -->
                    <img src="{{ asset('admincss/dist/img/AdminLTELogo.png') }}" alt="Project Logo"
                        class="img-fluid mb-3" style="width: 80px;">
                    <h2>Login</h2>
                </div>

                <!-- Flash Messages with Enhanced UI -->
                <div class="mt-4 d-flex justify-content-center">
                    @if (session('success'))
                    <div class="m-2 p-3 text-center btn btn-success ">
                        <h3>{{ session('success') }}</h3>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="m-2 p-3 text-center btn btn-danger ">
                        <h3>{{ session('error') }}</h3>
                    </div>
                    @endif
                </div>

                <!-- Login Form -->
                <div class="card-body p-4">
                    <form action="{{route('userLogin')}}" method="post">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" id="email"
                                placeholder="Enter your email" required>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" id="password"
                                placeholder="Enter your password" required>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100"
                            style="border-radius: 8px;">Login</button>
                    </form>
                </div>
            </div>

            <!-- Registration Link -->
            <div class="text-center mt-4">
                <p>Don't have an account? <a href="{{route('loadRegister')}}" class="text-primary">Sign Up</a></p>
            </div>
        </div>
    </div>
</div>
@endsection