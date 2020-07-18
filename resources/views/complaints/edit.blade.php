@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h1 class="text-center text-muted mb-4">Edit Your Complaint</h1>
                        <img src="{{ route('get.photo', ['fileName' => $complaint->photo]) }}" alt="{{ route('get.photo', ['fileName' => $complaint->photo]) }}" class="img-fluid mb-3">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('complaints.editPhoto', $complaint->id) }}" class="text-decoration-none">Edit photo</a>
                        </div>
                        <form action="{{ route('complaints.update', $complaint->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modern-form mb-3">
                                <textarea name="report" rows="4" class="form-control input-field @error('report') is-invalid @enderror" placeholder="Tell us what is your problem...">{{ $complaint->report }}</textarea>
                                <label for="name" class="input-label">Report</label>
                            </div>
                            @error('report')
                                <div class="invalid-feedback" style="display: unset;">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button class="btn btn-success" type="submit">Update Report</button>
                            <button class="btn btn-outline-danger" type="reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection