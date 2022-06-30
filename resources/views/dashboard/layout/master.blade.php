<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
    <head>
       @include('dashboard.layout.headcss')
    </head>
    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        @include('sweetalert::alert')
        @include('dashboard.layout.navbar')
        @include('dashboard.layout.sidebar')
        @yield('content')
        @include('dashboard.layout.footer')
        @include('dashboard.layout.footerjs')
    </body>
</html>
