@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>NIK</th>
                        <th>Level</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td><a href="{{ route('users.show', $user->id) }}" class="text-decoration-none">{{ $user->name }}</a></td>
                            <td>{{ $user->nik }}</td>
                            <td class="text-capitalize">{{ $user->level }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection