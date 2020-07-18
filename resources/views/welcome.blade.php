<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body style="overflow-x: hidden;">
        <main class="align-items-center d-flex justify-content-center" style="height: 90vh;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center">Welcome To Pengaduan Masyarakat</h1>
                    <p class="text-center text-muted">Tell Us what is Your problem...</p>
                    <div class="d-flex justify-content-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-success">Go To Dashboard</a>
                        @endauth
                        @guest
                            <a href="{{ route('dashboard') }}" class="btn btn-success">Getting Started</a>  
                        @endguest
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
