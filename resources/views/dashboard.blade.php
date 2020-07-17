@extends('layouts.app')

@section('content')
    @if (Auth::user()->level == 'public')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 d-flex align-items-center justify-content-center" style="height: 70vh;">
                    <div>
                        <h1 class="text-center mb-4">If You have a problem, let Us know...</h1>
                        <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 2rem;">
                            <a href="{{ route('complaints.create') }}" class="btn btn-success shadow-sm">Complaint Here !</a>
                            <span class="text-muted mx-2">Or</span>
                            <a href="{{ route('complaints.index') }}" class="btn btn-light shadow-sm">See Your Complaint's</a>
                        </div>
                        <a href="{{ route('complaints.complete') }}" class="text-muted text-decoration-none">Complete</a>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $complete % 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="{{ route('complaints.onProcess') }}" class="text-muted text-decoration-none">On Process</a>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar bg-warning" role="progressbar" style="width: {{ $onProcess % 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="{{ route('complaints.index') }}" class="text-muted text-decoration-none">Pending</a>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar bg-danger" role="progressbar" style="width: {{ $pending % 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 d-flex align-items-center justify-content-center" style="height: 70vh;">
                    <div>
                        <h1 class="text-center mb-4">Check all complaints of Your people</h1>
                        <div class="d-flex justify-content-center align-items-center" style="margin-bottom: 2rem;">
                            <a href="{{ route('complaints.index') }}" class="btn btn-success shadow-sm">Click Here !</a>
                        </div>
                        <a href="{{ route('complaints.complete') }}" class="text-muted text-decoration-none">Complete</a>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $complete % 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="{{ route('complaints.onProcess') }}" class="text-muted text-decoration-none">On Process</a>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar bg-warning" role="progressbar" style="width: {{ $onProcess % 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="{{ route('complaints.index') }}" class="text-muted text-decoration-none">Pending</a>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar bg-danger" role="progressbar" style="width: {{ $pending % 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
