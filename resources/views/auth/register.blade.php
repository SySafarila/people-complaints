@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h1 class="text-muted text-center">Register</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <div class="modern-form">
                                    <input type="text" class="form-control input-field" name="name" required>
                                    <label for="name" class="input-label">Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="modern-form">
                                    <input type="text" class="form-control input-field" name="username" required>
                                    <label for="username" class="input-label">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="modern-form">
                            <input type="email" class="form-control input-field" name="email" required>
                            <label for="email" class="input-label">Email</label>
                        </div>
                        <div class="modern-form">
                            <input type="number" class="form-control input-field" name="nik" required>
                            <label for="nik" class="input-label">NIK</label>
                        </div>
                        <div class="modern-form">
                            <input type="number" class="form-control input-field" name="phone" required>
                            <label for="phone" class="input-label">Phone Number</label>
                        </div>
                        <div class="modern-form">
                            <select name="level" id="level" class="custom-select input-field" required>
                                <option value="null" selected disabled>- Select Level -</option>
                                <option value="admin">Admin</option>
                                <option value="officer">Officer</option>
                                <option value="public">Public</option>
                            </select>
                            <label for="level" class="input-label">Level</label>
                        </div>
                        <div class="modern-form">
                            <input type="password" class="form-control input-field" name="password" required>
                            <label for="password" class="input-label">Password</label>
                        </div>
                        <div class="modern-form">
                            <input id="password-confirm" type="password" class="form-control input-field" name="password_confirmation" required>
                            <label for="password-confirm" class="input-label">Confirm Password</label>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-success mx-1">Register</button>
                            <button type="reset" class="btn btn-outline-danger mx-1">Reset</button>
                        </div>
                    </form>
                    <p class="text-center mb-0 mt-2"><a href="{{ route('login') }}" class="text-decoration-none">Login</a></p>
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
