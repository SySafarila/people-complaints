@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('status-success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status-success') }}
                    </div>
                @endif
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h3 class="text-center text-muted">User Data</h3>
                        <p>Name : {{ $user->name }}</p>
                        <p>Email : {{ $user->email }}</p>
                        <p>NIK : {{ $user->nik }}</p>
                        <p class="text-capitalize">Level : {{ $user->level }}</p>
                        <hr>
                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @csrf
                            <p class="text-muted font-weight-bold">Update Level</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="level" id="admin" value="admin" @if($user->level == 'admin') checked @endif>
                                <label class="form-check-label" for="admin">
                                  Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="level" id="officer" value="officer" @if($user->level == 'officer') checked @endif>
                                <label class="form-check-label" for="officer">
                                  Officer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="level" id="public" value="public" @if($user->level == 'public') checked @endif>
                                <label class="form-check-label" for="public">
                                  Public
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm btn-block my-2">Update</button>
                        </form>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-block btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection