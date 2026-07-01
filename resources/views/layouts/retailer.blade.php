<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>@yield('title') | Indian Classic</title>

    {{-- Google Font --}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    {{-- AdminLTE --}}
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    {{-- DataTables --}}
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    @stack('styles')

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">

            <li class="nav-item">

                <a class="nav-link"
                   data-widget="pushmenu"
                   href="#">

                    <i class="fas fa-bars"></i>

                </a>

            </li>

        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item">

                <span class="nav-link">

                    {{ auth()->user()->username }}

                </span>

            </li>

            <li class="nav-item">

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button
                        class="btn btn-link nav-link">

                        Logout

                    </button>

                </form>

            </li>

        </ul>

    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="{{ route('retailer.dashboard') }}"
           class="brand-link">

            <span class="brand-text font-weight-light">

                Indian Classic

            </span>

        </a>

        <div class="sidebar">

            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview">

                    <li class="nav-item">

                        <a href="{{ route('retailer.dashboard') }}"
                           class="nav-link">

                            <i class="nav-icon fas fa-home"></i>

                            <p>

                                Dashboard

                            </p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="{{ route('retailer.spinner.index') }}"
                           class="nav-link">

                            <i class="nav-icon fas fa-dice"></i>

                            <p>

                                Spinner Game

                            </p>

                        </a>

                    </li>

                </ul>

            </nav>

        </div>

    </aside>

    {{-- Content --}}
    <div class="content-wrapper">

        @yield('content')

    </div>

    {{-- Footer --}}
    <footer class="main-footer">

        <strong>

            &copy; {{ date('Y') }} Indian Classic

        </strong>

    </footer>

</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- AdminLTE --}}
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')

</body>

</html>