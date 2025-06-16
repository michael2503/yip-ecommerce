<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link href="{{ asset("assets/css/dropify.min.css") }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset("assets/css/dropzone.min.css") }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/admin-style.css') }}">

    </head>
    <body>



        <div class="page-wrapper chiller-theme toggled">
            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                <i class="fas fa-bars"></i>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                    <div class="sidebar-brand">
                        <a href="#">ecommerce</a>
                        <div id="close-sidebar">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="sidebar-header">
                        <div class="user-pic">
                            <img class="img-responsive img-rounded" src="{{ asset('assets/images/picture.jpeg') }}" alt="User picture">
                        </div>
                        <div class="user-info">
                            <span class="user-name"><strong>{{ Auth::user()->name }}</strong> </span>
                            <span class="user-role">Administrator</span>
                            <span class="user-status">
                                <i class="fa fa-circle"></i>
                                <span>Online</span>
                            </span>
                        </div>
                    </div>

                    <!-- sidebar-search  -->
                    <div class="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ route('adminDashboard') }}">
                                    <i class="fa fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-gem"></i>
                                    <span>Products</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{ route('admincategory') }}">Product Category</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminproduct') }}">All Products</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminproduct.add') }}">Add New</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="{{ route('adminOrder') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
                </div>
                <!-- sidebar-content  -->
                <div class="sidebar-footer">
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span class="badge-sonar"></span>
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logoutAdmin').submit();">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div>
            </nav>

            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid">

                    <x-success />

                    {{ $slot }}


                    <hr class="mt-5">

                    <footer class="text-center">
                        <div class="mb-2">
                            <small>
                                © {{ date('Y') }} Ecommerce
                                Omotosho Michael
                            </small>
                        </div>
                    </footer>
                </div>
            </main>
            <!-- page -content" -->
        </div>



        <form method="POST" action="{{ route('logout') }}" id="logoutAdmin">
            @csrf
        </form>

        {{-- WYSIWYG --}}
        <script src="{{ asset('assets/wysiwug/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/wysiwug/fastclick.js') }}"></script>
        <script src="{{ asset('assets/wysiwug/tinymce/tinymce.min.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>

        {{-- UPLOADS --}}
        <script src="{{ asset("assets/js/dropzone.min.js") }}"></script>
        <script src="{{ asset("assets/js/dropify.min.js") }}"></script>
        <script src="{{ asset("assets/js/form-fileuploads.init.js") }}"></script>

        <script src="{{ asset('assets/js/main.js') }}"></script>

    </body>
</html>
