<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
<meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
<meta name="author" content="PIXINVENT">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title')</title>
<link rel="apple-touch-icon" href="{{ asset('dashboard/app-assets/images/ico/apple-icon-120.png')}}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboard/app-assets/images/ico/favicon.ico')}}">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
<!-- BEGIN: Vendor CSS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/vendors-rtl.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/forms/selects/select2.min.css') }}">

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}"> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}"> --}}

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css') }}"> --}}
<!-- END: Vendor CSS-->
@yield('fileinputcss')
<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/custom-rtl.css')}}">
<!-- END: Theme CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/charts/morris.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/fonts/simple-line-icons/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/core/colors/palette-gradient.css')}}">

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/plugins/pickers/daterange/daterange.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/plugins/forms/switch.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/fonts/feather/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/fonts/line-awesome/css/line-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/fonts/simple-line-icons/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css-rtl/plugins/animate/animate.css') }}">

<!-- END: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/pickdate/themes/classic.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/pickdate/themes/classic.date.css') }}">

@yield('css')
<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/style-rtl.css') }}">
<!-- END: Custom CSS-->
<style>
    .table th, .table td {
    padding: 10px !important;
}

.picker__select--month, .picker__select--year {
    height: 3rem;
}

</style>
