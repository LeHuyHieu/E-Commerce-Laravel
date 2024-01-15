<!doctype html>
<html lang="en">
<head>
    @include('elements.admin.head')
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
</body>
</html>