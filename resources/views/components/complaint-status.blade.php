<div class="d-flex mb-3">
    <a href="{{ route('complaints.index') }}" class="mr-2"><small class="badge badge-danger shadow-sm">Pending | {{ $pending }}</small></a>
    <a href="{{ route('complaints.onProcess') }}" class="mr-2"><small class="badge badge-warning shadow-sm">On Process | {{ $onProcess }}</small></a>
    <a href="{{ route('complaints.complete') }}" class="mr-2"><small class="badge badge-success shadow-sm">Complete | {{ $complete }}</small></a>
    @if (Auth::user()->level == 'public')
        <a href="{{ route('complaints.create') }}" class="mr-2"><small class="badge badge-primary shadow-sm">Create Complaint</small></a>
    @endif
</div>