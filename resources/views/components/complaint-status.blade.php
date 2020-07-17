<div class="d-flex mb-3">
    <a href="{{ route('complaints.index') }}" class="mr-2"><small class="badge badge-light shadow-sm">Pending | {{ $pending }}</small></a>
    <a href="{{ route('complaints.onProcess') }}" class="mr-2"><small class="badge badge-light shadow-sm">On Process | {{ $onProcess }}</small></a>
    <a href="{{ route('complaints.complete') }}" class="mr-2"><small class="badge badge-light shadow-sm">Complete | {{ $complete }}</small></a>
</div>