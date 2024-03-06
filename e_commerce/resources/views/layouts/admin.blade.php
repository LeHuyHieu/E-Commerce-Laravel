<!doctype html>
<html lang="en">
<head>
    @include('elements.admin.head')
    @yield('custom_css')
</head>
<body>
    <!--wrapper-->
    <div class="wrapper">
        @include('elements.admin.slider_bar')
        @include('elements.admin.header')
        @yield('content')
        @include('elements.admin.footer')
    </div>
    @include('elements.admin.js')
    @yield('custom_js')
</body>
</html>
