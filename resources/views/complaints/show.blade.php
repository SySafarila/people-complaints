@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-3">
                @if (session('status-success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status-success') }}
                    </div>
                @endif
                <div class="card border-0 shadow">
                    <img src="{{ route('get.photo', ['fileName' => $complaint->photo]) }}" class="card-img-top" alt="{{ route('get.photo', ['fileName' => $complaint->photo]) }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <small class="badge @if($complaint->status == 'complete') badge-success @else badge-light @endif text-capitalize shadow-sm">{{ $complaint->status }}</small>
                            <small class="text-muted">{{ $complaint->created_at->diffForHumans() }}</small>
                        </div>
                        <p style="white-space: pre;">{{ $complaint->report }}</p>
                        @if (Auth::user()->level == 'admin' or Auth::user()->level == 'officer')
                            <small class="text-muted text-capitalize">Reporter : {{ $complaint->user->name }}</small>
                        @endif
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
                            {{-- <p class="bg-light shadow-sm rounded-pill px-2"><span class="text-muted">{{ $response->user->name }}: </span> {{ $response->response }}</p> --}}
                            <div class="mb-1">
                                <span class="text-muted">{{ $response->user->name }}</span>
                                <br>
                                <p class="m-0">{{ $response->response }}</p>
                                <small class="text-muted">{{ $response->created_at->diffForHumans() }}</small>
                            </div>
                            <hr>
                        @endforeach
                        @if ($complaint->responses->count() == 0)
                            <p class="text-muted">Empty</p>
                            <hr>
                        @endif
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
            @if (Auth::user()->level == 'admin' or Auth::user()->level == 'officer')
                <div class="col-md-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <p class="font-weight-bold">Update Status</p>
                            <form action="{{ route('complaints.setStatus', $complaint->id) }}" method="post">
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="pending" value="pending" @if($complaint->status == 'pending') checked @endif>
                                    <label class="form-check-label" for="pending">
                                      Pending
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="on process" value="on process" @if($complaint->status == 'on process') checked @endif>
                                    <label class="form-check-label" for="on process">
                                      On Process
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="complete" value="complete" @if($complaint->status == 'complete') checked @endif>
                                    <label class="form-check-label" for="complete">
                                      Complete
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-sm btn-block btn-success mt-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection