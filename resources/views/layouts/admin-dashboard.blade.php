<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name') }} :: {{ $title }}</title>
    <link rel="apple-touch-icon" href="{{ asset('web_components/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('web_components/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')}}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/themes/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/themes/bordered-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/themes/semi-dark-layout.css')}}">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/plugins/forms/form-validation.css')}}">
<!-- END: Page CSS-->


<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('web_components/assets/css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.1/apexcharts.min.css" integrity="sha512-nnNXPeQKvNOEUd+TrFbofWwHT0ezcZiFU5E/Lv2+JlZCQwQ/ACM33FxPoQ6ZEFNnERrTho8lF0MCEH9DBZ/wWw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<!-- END: Custom CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/pages/dashboard-ecommerce.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: DatePicker CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_components/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
    <!-- END: DatePicker CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" integrity="sha512-KulI0psuJQK8UMpOeiMLDXJtGOZEBm8RZNTyBBHIWqoXoPMFcw+L5AEo0YMpsW8BfiuWrdD1rH6GWGgQBF59Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('styles')
</head>

 <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">


@include('pages.admin.includes.header-nav')
@include('pages.admin.includes.main-menu')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- BEGIN: Content-->
<div class="app-content content {{ $layoutClass ?? 'todo-application' }}">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            @include('pages.admin.includes.breadcrumb')
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
 <!-- END: Content-->

 <div class="sidenav-overlay"></div>
 <div class="drag-target"></div>
{{-- <div class="progress progress-bar-primary mb-2" id="document-re-upload-progress-bar" style="margin: 15px;position: fixed;bottom: 10px;width: 95%; display: none;">
    <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 0%; height: 10px;">
        0%
    </div>
</div> --}}
@include('pages.admin.includes.footer')

 <!-- BEGIN: Vendor JS-->
 <script src="{{ asset('web_components/app-assets/vendors/js/vendors.min.js') }}"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="{{ asset('web_components/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="{{ asset('web_components/app-assets/js/core/app-menu.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/js/core/app.js') }}"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <script src="{{ asset('web_components/app-assets/js/scripts/pages/app-user-list.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/js/scripts/charts/chart-apex.js') }}"></script>
 <script src="{{ asset('web_components/app-assets/js/scripts/pages/modal-edit-user.js') }}"></script>
 {{-- <script src="{{ asset('web_components/app-assets/js/scripts/pages/app-user-view-account.js') }}"></script> --}}
 <script src="{{ asset('web_components/app-assets/js/scripts/pages/app-user-view.js') }}"></script>
 {{-- <script src="{{ asset('web_components/app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script> --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.1/apexcharts.min.js" integrity="sha512-Gpg0M5UOTFSHGglemXUOUzL1LyO8MT0fxmEAjGN8jNlY6oSOsLerF1/vuXrqJXKyV5QIay12trwDDhmRJHZisA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.3/chart.min.js" integrity="sha512-fMPPLjF/Xr7Ga0679WgtqoSyfUoQgdt8IIxJymStR5zV3Fyb6B3u/8DcaZ6R6sXexk5Z64bCgo2TYyn760EdcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
 <!-- END: Page JS-->


<script src="{{ asset('web_components/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
       {{-- <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script> --}}
<script src="{{ asset('web_components/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>




       {{-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script> --}}

<!-- BEGIN: DataTable JS-->
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>

<!-- END: DataTable JS-->

{{-- <script src="{{ asset('js/common.js') }}"></script> --}}

<!-- BEGIN: Pickdate JS-->
<script src="{{ asset('web_components/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ asset('web_components/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<!-- END: Pickdate JS-->

<!-- BEGIN: select2 JS-->
{{-- <script src="{{ asset('web_components/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script> --}}

<!-- END: select2 JS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.3/chart.min.js" integrity="sha512-fMPPLjF/Xr7Ga0679WgtqoSyfUoQgdt8IIxJymStR5zV3Fyb6B3u/8DcaZ6R6sXexk5Z64bCgo2TYyn760EdcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@include('pages.admin.includes.toastr')
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
@stack('scripts')
</body>
</html>
