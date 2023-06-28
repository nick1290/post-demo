@extends('layouts.master')
@section('styles')
    <style>
        .card-header{
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
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="text" id="email_address" class="form-control" name="email" required
                                        autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                                    <input type="password" id="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        Login
                                    </button>
                                </div>
                                <label for="">Don't Have an account?</label>
                                <a href="{{route('register')}}">Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
