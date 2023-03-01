<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="icon" type="icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}" />

<body>
    @hasSection('no-content')
    @yield('no-content')
    @else
    <main>
        @include('includes.components.navbar')
        <div class="content">
            @yield('content')
        </div>
    </main>
    @endif
</body>

</html>