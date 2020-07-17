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
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('complaints.edit', $complaint->id) }}" class="text-decoration-none">Edit this complaint</a>
                            <form action="{{ route('complaints.destroy', $complaint->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                        <hr>
                        <p class="font-weight-bold">Responses</p>
                        @foreach ($complaint->responses as $response)
                            <p class="bg-light shadow-sm rounded-pill px-2"><span class="text-muted">{{ $response->user->name }}: </span> {{ $response->response }}</p>
                        @endforeach
                        <hr>
                        <form action="{{ route('complaints.addResponse', $complaint->id) }}" method="post">
                            @csrf
                            <div class="modern-form mb-3">
                                <textarea name="response" rows="4" class="form-control input-field @error('response') is-invalid @enderror" placeholder="Write your response here..."></textarea>
                                <label for="name" class="input-label">Response</label>
                            </div>
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection