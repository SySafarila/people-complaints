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
                            <a href="{{ route('complaints.edit', $complaint->id) }}" class="text-decoration-none">Edit</a>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
                                Delete
                            </button>
                        </div>
                        <hr>
                        <p class="font-weight-bold">Responses</p>
                        @foreach ($complaint->responses as $response)
                            {{-- <p class="bg-light shadow-sm rounded-pill px-2"><span class="text-muted">{{ $response->user->name }}: </span> {{ $response->response }}</p> --}}
                            <div class="mb-1">
                                <div class="d-flex align-items-center">
                                    <p class="text-muted m-0">{{ $response->user->name }}</p>
                                    @if ($response->user->level == 'admin' or $response->user->level == 'officer')
                                        <span class="material-icons ml-1 text-primary" style="font-size: 14px;">verified</span>
                                    @endif
                                </div>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p class="m-0">Are you sure want to delete this complaint ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('complaints.destroy', $complaint->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection