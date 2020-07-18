@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h1 class="text-center text-muted mb-4">Edit Your Complaint</h1>
                        <form action="{{ route('complaints.updatePhoto', $complaint->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="photo" class="text-muted">Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}" accept="image/*" required>
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
                            <button class="btn btn-success" type="submit">Update Photo</button>
                            <button class="btn btn-outline-danger" type="reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection