@extends('layouts.auth-layout')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center bg-primary text-white rounded-top">
                    <h2>Register</h2>
                </div>

                <div id="flash-message-container" class="mt-3">
                    @if (session('success'))
                    <div class="alert alert-success text-white bg-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger text-white bg-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>

                <div class="card-body p-4">
                    <form action="{{route('userRegister')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            {{-- <input type="text" name="name" class="form-control p-3" id="name"
                                placeholder="Enter your name" required> --}}
                            <select name="name" id="name">
                                <option value="">Select Option</option>
                                <option value="Super Admin">Super Admin</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="companyName" class="form-label">Company Name</label>
                            <input type="text" name="companyName" class="form-control p-3" id="companyName"
                                placeholder="Enter your company name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control p-3" id="email"
                                placeholder="Enter your email address" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control p-3" id="password"
                                placeholder="Enter your password" required>
                        </div>

                        <button type="submit"
                            class="btn btn-primary btn-lg w-100 rounded-pill p-3"><b>Register</b></button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p>Already have an account? <a href="{{route('loadLogin')}}" class="text-primary fw-bold">Login</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto dismiss flash messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessages = document.querySelectorAll('#flash-message-container .alert');

        flashMessages.forEach(message => {
            // Automatically hide after 5 seconds
            setTimeout(() => {
                message.classList.remove('show');
                setTimeout(() => {
                    message.style.display = 'none';
                }, 500);
            }, 5000);
        });
    });
</script>

@endsection