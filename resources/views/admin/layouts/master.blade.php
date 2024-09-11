<!doctype html>
<html class="no-js" lang="fa">
@include('admin.sections.head')
<body class="rtl persianumber">
@include('admin.sections.scripts')
    <div class="bmd-layout-container bmd-drawer-f-l avam-container animated bmd-drawer-in">
        @include('admin.sections.header')
        @include('admin.sections.sidebar')
        @yield('content')
    </div>
@yield('scripts')
</body>
</html>
