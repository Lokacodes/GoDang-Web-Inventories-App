<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GO-DANG</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/s/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/dashboard.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />
    <link href="{{ asset('assets/jqueryui/jquery-ui.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="container-scroller">
        <!-- navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/"><img src="{{ asset('assets/images/logo.png') }}"
                        class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ asset('assets/images/logo.png') }}"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    @auth
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <i class="icon-head mx-0"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="ti-arrow-circle-up text-primary"></i>
                                    Log Out
                                </a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <i class="icon-head mx-0"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="/login">
                                    <i class="ti-arrow-circle-down text-primary"></i>
                                    Log In
                                </a>
                            </div>
                        </li>
                    @endauth
                    <li class="nav-item nav-settings d-none d-lg-flex">
                        <a class="nav-link" href="#">
                            <i class="icon-ellipsis"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <!-- sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    @if (Auth::user()->role == 'super')
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="ti-home menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/barang">
                                <i class="ti-bag menu-icon"></i>
                                <span class="menu-title">Barang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/receiving">
                                <i class="ti-shopping-cart menu-icon"></i>
                                <span class="menu-title">Receiving</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/sending">
                                <i class="ti-truck menu-icon"></i>
                                <span class="menu-title">Sending</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false"
                                aria-controls="form-elements">
                                <i class="ti-notepad menu-icon"></i>
                                <span class="menu-title">Master Data</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="master">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="/kategori">Kategori</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/brand">Brand</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/ekspedisi">Ekspedisi</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false"
                                aria-controls="form-elements">
                                <i class="icon-paper menu-icon"></i>
                                <span class="menu-title">Report</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="report">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="/sent">Sent</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/received">Received</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/stok">Stok</a></li>
                                </ul>
                            </div>
                        </li>
                    @elseif (Auth::user()->role == 'kasir')
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="ti-home menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/receive">
                                <i class="ti-shopping-cart menu-icon"></i>
                                <span class="menu-title">Receiving</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/sending">
                                <i class="ti-truck menu-icon"></i>
                                <span class="menu-title">Sending</span>
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 'user')
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="ti-home menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false"
                                aria-controls="form-elements">
                                <i class="icon-paper menu-icon"></i>
                                <span class="menu-title">Report</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="report">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"><a class="nav-link" href="/sent">Sent</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/received">Received</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/stok">Stok</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are You Sure To Logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/card.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/jqueryui/jquery-ui.js') }}"></script>
    <!-- End custom js for this page-->
    @stack('page-script')

</body>

</html>
