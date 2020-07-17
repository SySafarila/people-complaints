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
                    <div class="card-body">
                        <h1 class="text-center text-muted mb-4">Write Your Complaint</h1>
                        <form action="{{ route('complaints.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modern-form">
                                <textarea name="report" rows="4" class="form-control input-field @error('report') is-invalid @enderror" placeholder="Tell us what is your problem...">{{ old('report') }}</textarea>
                                <label for="name" class="input-label">Report</label>
                            </div>
                            @error('report')
                                <div class="invalid-feedback" style="display: unset;">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mt-2">
                                <label for="photo" class="text-muted">Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}" required>
                                    <label class="custom-file-label text-truncate" style="padding-right: 4.5rem;" for="photo">Choose image</label>
                                </div>
                                @error('photo')
                                <div class="invalid-feedback" style="display: unset;">
                                    {{ $message }}
                                </div>
                                @enderror
                                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
                                <script>
                                    $(document).ready(function () {
                                        bsCustomFileInput.init()
                                    });
                                </script>
                            </div>
                            <button class="btn btn-success" type="submit">Send Report</button>
                            <button class="btn btn-outline-danger" type="reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4 class="text-muted">Your last 5 complaint's</h4>
                @foreach ($complaints as $complaint)
                    <div class="card border-0 shadow mb-3">
                        <a href="{{ route('complaints.show', $complaint->id) }}" class="stretched-link"></a>
                        <span class="badge badge-light shadow-sm text-capitalize position-absolute rounded-0">{{ $complaint->status }}</span>
                        <span class="badge badge-success shadow-sm position-absolute rounded-0" style="right: 0;">{{ $complaint->created_at->diffForHumans() }}</span>
                        <img src="{{ route('get.photo', ['fileName' => $complaint->photo]) }}" class="card-img-top" alt="{{ route('get.photo', ['fileName' => $complaint->photo]) }}">
                        <div class="card-body">
                            <p class="m-0" style="white-space: pre-wrap;">{{ $complaint->report }}</p>
                        </div>
                    </div>
                @endforeach
                @if ($complaints->count() == 0)
                    <p class="text-muted">Empty</p>
                @endif
            </div>
        </div>
    </div>
@endsection