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
                    <img src="{{ route('get.photo', ['fileName' => $complaint->photo]) }}" class="card-img-top" alt="{{ route('get.photo', ['fileName' => $complaint->photo]) }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="badge badge-light text-capitalize shadow-sm">{{ $complaint->status }}</small>
                            <small class="text-muted">{{ $complaint->created_at->diffForHumans() }}</small>
                        </div>
                        <p style="white-space: pre;">{{ $complaint->report }}</p>
                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="text-decoration-none">Edit this complaint</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection