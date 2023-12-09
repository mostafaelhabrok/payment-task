<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? "App"}}</title>

    @include('styles')

    @yield('css')

</head>

<body>

    @include('header')


    <div class="content">
        @yield('content')
    </div>

    @include('scripts')

    @yield('js')

</body>
</html>
