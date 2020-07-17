@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex align-items-center justify-content-center" style="height: 70vh;">
            <div>
                <h1 class="text-center">If You have a problem, let Us know...</h1>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('complaints.create') }}" class="btn btn-success shadow-sm">Complaint Here !</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
