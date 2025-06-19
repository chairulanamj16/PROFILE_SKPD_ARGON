<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>KIT</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <style>
        #sidenav-main {
            width: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            max-height: 100vh;
            /* Ensure the sidebar doesn't exceed the viewport height */
        }

        .navbar-nav {
            padding-left: 0;
            margin-left: 0;
            list-style: none;
            width: 100%;
            /* Ensure the nav list takes up the full width */
        }

        .nav-item {
            white-space: nowrap;
            /* Prevent items from wrapping */
            overflow: hidden;
            text-overflow: ellipsis;
            /* Ensure text truncation */
        }

        .nav-link {
            display: flex;
            align-items: center;
            overflow: hidden;
            text-overflow: ellipsis;
            /* Ensure text truncation */
            max-width: 100%;
            /* Ensure the link doesn't exceed the container width */
        }

        .icon {
            flex-shrink: 0;
            /* Prevent icon from shrinking */
        }


        .table {
            font-size: 12px !important;
            border: 1px solid #343a40 !important;
        }

        .table tr td {
            padding-top: 2px !important;
            padding-bottom: 2px !important;
        }

        .table th,
        .table td {
            border: 1px solid #343a40 !important;
            font-size: 12px !important;
        }

        .table td {
            padding: 0px 3px !important;
        }


        .table .form-control-table {
            border: none;
            background-color: transparent !important;
        }

        .table tr td .form-control-table:focus {
            border: none !important;
            background-color: transparent;
            outline: none;
            box-shadow: none;
        }

        .table .btn-group .btn {
            border-radius: 0px;

        }

        .table tr .border_none {
            border: none !important;
        }

        .parent-sidebar {
            border-radius: 10px;
        }

        .parent-sidebar .nav-link:hover,
        .nav-item .nav-link:hover {
            background-color: rgba(105, 108, 255, 0.16) !important;
        }



        .bg-primary {
            /* background-color: #333232 !important; */
            /* background-color: rgba(105, 108, 255, 0.16) !important; */
        }

        .bg-menu {
            /* background-color: #333232 !important; */
            background-color: rgba(105, 108, 255, 0.161) !important;
        }

        .text-primary {
            /* color: #696cff !important; */
            color: #333232 !important;
        }

        .text-menu {
            /* color: #696cff !important; */
            color: #696cff !important;
        }

        /* .btn-primary {
            background-color: #333232 !important;
        } */
        .menu-item {}

        .ckeditor-content p {
            font-size: 12px;
        }

        /* Select2 */

        .table .tr .select2-container--default .select2-selection--single {
            border: none !important;
            box-shadow: none !important;
            width: 100% !important;
        }

        .select2-container {
            width: 100% !important;
            /* Mengatur kontainer Select2 agar lebar 100% */
        }

        /* Mengubah tinggi input Select2 */
        .filter .select2-container .select2-selection--single {
            height: 42px;
            border: #d1cfcf solid 1px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 8px;
        }

        .filter .select2-container .select2-selection--multiple {
            height: 42px;
            border: #d1cfcf solid 1px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 8px;
        }

        .btn {
            box-shadow: none !important;
        }
    </style>

    @stack('css')
</head>

<body class="g-sidenav-show ">
    <div class="min-height-300 position-absolute w-100"></div>
    @include('component.sidebar')
    <main class="main-content position-relative border-radius-lg">
        @include('component.navbar2')
        <div class="container-fluid py-4">
            @yield('content')
            @include('component.footer')
        </div>
    </main>



    @include('component.argon-config')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"></script>
    @livewireScripts
    @php
        $scriptView = 'backend.v1.' . Route::currentRouteName() . '.script';
    @endphp
    @stack('js')
    @if (View::exists($scriptView))
        @include($scriptView)
    @endif
    @stack(Route::currentRouteName())
</body>

</html>
