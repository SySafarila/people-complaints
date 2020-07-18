@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body p-4">
                    <h1 class="text-muted text-center">Login</h1>
                    <div class="d-flex justify-content-center">
                        <h1 class="material-icons text-primary" style="font-size: 4.5rem;">fingerprint</h1>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="modern-form">
                            <input type="email" class="form-control input-field" name="email" required>
                            <label for="email" class="input-label">Email</label>
                        </div>

                        <div class="modern-form">
                            <input type="password" class="form-control input-field" name="password" required>
                            <label for="password" class="input-label">Password</label>
                        </div>

                        <div class="custom-control custom-checkbox my-2">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                            <label class="custom-control-label" for="remember" style="cursor: pointer; user-select: none;">Remember me</label>
                        </div>

                        <a href="{{ route('password.request') }}" class="text-primary font-weight-bold text-decoration-none">Forgot password ?</a>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('register') }}" class="text-primary font-weight-bold text-decoration-none">Create Account</a>
                            <button type="submit" class="btn btn-sm btn-success">Login</button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <hr>
                        <ul class="pl-3 mt-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
