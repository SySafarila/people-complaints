@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <p class="text-muted font-weight-bold">Update Response</p>
                        <form action="{{ route('response.update', ['complaint' => $response->complaint_id, 'response' => $response->id]) }}" method="post" class="d-print-none">
                            @csrf
                            <div class="modern-form mb-3">
                                <textarea name="response" rows="4" class="form-control input-field @error('response') is-invalid @enderror" placeholder="Write your response here...">{{ $response->response }}</textarea>
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