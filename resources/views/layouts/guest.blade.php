<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Yip Online Ecommerce System">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Mobile Specific -->


    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="Yip Online Ecommerce System" />
    <meta property="og:title" content="@yield('ogTitle')">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Yip Online Ecommerce System">
    <meta property="og:locale" content="en_US">
    <meta property="og:url" content="@yield('ogUrl')" />

    <meta prefix="og: http://ogp.me/ns#" property="og:title" content="@yield('ogTitle')">
    <meta prefix="og: http://ogp.me/ns#" property="og:image" content="@yield('ogImage')">
    <meta prefix="og: http://ogp.me/ns#" property="og:description" content="@yield('description')">
    <meta prefix="og: http://ogp.me/ns#" property="og:url" content="@yield('ogUrl')">

    <meta name="twitter:card" content="Yip Online Ecommerce System">
    <meta name="twitter:site" content="Yip Online Ecommerce System">
    <meta name="twitter:title" content="@yield('ogTitle')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('ogImage')">
    <link rel="canonical" href="@yield('ogUrl')">
    <link rel="alternate" href="@yield('ogUrl')">

    <link rel="shortcut icon" href="@yield('ogImage')" type="image/x-icon" />

        <!-- Fonts -->

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


    </head>
    <body>
        @php $countCart = 0; @endphp

        @if(session('cart'))
        @foreach(session('cart') as $details)
        @php $countCart += $details['quantity']; @endphp
        @endforeach
        @endif

        <header>
            <div class="topheader">
                <div class="container container1230">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7 col-md-10 col-sm-9 remove575">
                            <div class="d-flex justify-content-start">
                                <p class='mb-0'>
                                    <span class='phoneTitle'>Call Us: </span>
                                    <span class="phone ml-2">+(084) 123 - 456 88</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-2 col-sm-3">
                            <div class="socialside d-flex justify-content-end">
                                <a class='ml-2' href="#" tabIndex={5}>
                                    <img src=""{{ asset('assets/images/linkedin.png') }} />
                                </a>
                                <a class='ml-2' href="#" tabIndex={5}>
                                    <img src="{{ asset('assets/images/twitter.png') }}" />
                                </a>
                                <a class='ml-2' href="#" tabIndex={5}>
                                    <img src="{{ asset('assets/images/facebook.png') }}" />
                                </a>
                                <a class='ml-2' href="#" tabIndex={5}>
                                    <img src="{{ asset('assets/images/instagram.png') }}" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bottomheader bottomheaderBorder">
                <div class="container container1230">
                    <div class="d-flex justify-content-between">
                        <div class="themenus">
                            <div class="d-flex justify-content-between">
                                <div class="link mr-5">
                                    <a href="{{ route('homePage') }}">
                                        <img src="{{ asset('assets/images/yip-online.png') }}" class='logo'/>
                                    </a>
                                </div>
                                <div class="link mt-2 mr-3">
                                    <a href="{{ route('homePage') }}" @if($attributes['activepage'] == 'home') class="active" @endif>
                                        Home
                                    </a>
                                </div>
                                <div class="link mt-2 mr-3">
                                    <a href="{{ route('products') }}" @if($attributes['activepage'] == 'product') class="active" @endif>
                                        Product
                                    </a>
                                </div>
                                @if(Auth::user() && Auth::user()->account_type == 'user')
                                <div class="link mt-2 mr-3">
                                    <a href="{{ route('getOrder') }}" @if($attributes['activepage'] == 'order') class="active" @endif>
                                        Orders
                                    </a>
                                </div>
                                <div class="link mt-2 mr-3">
                                    <a href="{{ route('getWishList') }}" @if($attributes['activepage'] == 'wishlist') class="active" @endif>
                                        Wishlist
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="rightside remove800">
                            <div class="d-flex justify-content-end">

                                <div class="link mr-4">
                                    <a href="{{ route('shoppingCart') }}" class='login navcartlink'>
                                        <span class="fa fa-shopping-cart navcart"></span>
                                        <span class="count ajaxCountOne">{{ $countCart }}</span>
                                    </a>
                                </div>

                                @if (Auth::user() && Auth::user()->account_type == 'user')
                                <div class="createaccbtn mt-2">
                                    <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('userLogout').submit();">
                                        Logout
                                    </a>
                                </div>
                                @else
                                <div class="link mt-3 mr-4">
                                    <a href="{{ route('login') }}" class='login'>
                                        <span>Login</span>
                                    </a>
                                </div>
                                <div class="createaccbtn mt-2">
                                    <a href="{{ route('register') }}">
                                        Register
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="mobileview">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('homePage') }}">
                                        <img src="{{ asset('assets/images/yip-online.png') }}" class='logo'/>
                                    </a>
                                </div>

                                <div class="d-flex">
                                    <div class="link mr-4">
                                        <a href="{{ route('shoppingCart') }}" class='login navcartlink'>
                                            <span class="fa fa-shopping-cart navcart mobile"></span>
                                            <span class="count ajaxCountTwo mobile">{{ $countCart }}</span>
                                        </a>
                                    </div>

                                    <input class="side-menu" type="checkbox" id="side-menu"/>
                                    <label class="hamb" for="side-menu"><span class="hamb-line"></span></label>

                                    <nav class="nav">
                                        <ul class="menu">
                                            <li>
                                                <a href="{{ route('homePage') }}">
                                                    Home
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('products') }}">
                                                    Product
                                                </a>
                                            </li>
                                            @if (Auth::user() && Auth::user()->account_type == 'user')
                                            <li>
                                                <a href="{{ route('dashboard') }}">
                                                    Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('getOrder') }}">
                                                    Orders
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('getWishList') }}">
                                                    Wishlist
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('userLogout').submit();">
                                                    Logout
                                                </a>
                                            </li>
                                            @else
                                            <li>
                                                <a href="{{ route('login') }}">
                                                    Login
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('register') }}">
                                                    register
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
         <form id="userLogout" action="{{route('logout')}}" method="post">
            @csrf
        </form>


        {{ $slot }}


        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('assets/js/slick.min.js') }}"></script>

        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    </body>
</html>
