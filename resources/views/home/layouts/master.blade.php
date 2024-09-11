<!DOCTYPE html>
<html lang="en">
@include('home.sections.head')
<body class="preload">
@php
    $active = ''
@endphp
{{--@include('home.sections.preloader')--}}
@include('home.sections.header')

<main>
    @yield('content')
</main>

@include('home.sections.footer')
@include('home.sections.CTT')
@include('home.sections.scripts')
@yield('scripts')
</body>
</html>
