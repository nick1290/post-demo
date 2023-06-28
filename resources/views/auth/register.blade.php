@extends('layouts.master')
@section('styles')
    <style>
        .card-header {
            background: none;
            border-bottom: none;
        }
    </style>
@endsection
@section('content')
    <main class="login-form m-5">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Register</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input type="text" id="name" class="form-control" name="name" required
                                        autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="text" id="email_address" class="form-control" name="email" required
                                        autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Contact</label>
                                    <input type="text" id="contact" class="form-control" name="contact" required
                                        autofocus>
                                    @if ($errors->has('contact'))
                                        <span class="text-danger">{{ $errors->first('contact') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <input type="password" id="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        Register
                                    </button>
                                </div>
                                <label for="">Already have account?</label>
                                <a href="{{ route('login') }}">Login</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
