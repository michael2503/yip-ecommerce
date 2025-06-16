<x-guest-layout activepage="home">

    @section('title', "Home Page")

    @section('description', "Welcome to Yip Online Ecommerce")
    @section('ogTitle', 'Welcome to Yip Online Ecommerce')
    @section('ogImage', asset('assets/images/yip-online.png'))
    @section('ogUrl', Request::url())


    <div class='wrapper'>

        <section class='homebanner'>
            <div class='container-fluid'>
                <div class='row no-gutters'>
                    <div class='col-xl-6 col-lg-6 col-md-6'>
                        <div class='bannerwriteup'>
                            <p class='smalltitle'>WELCOME TO YIPONLINE</p>
                            <h1>Promoting Ecommerce System.</h1>
                            <p class='description'>Creating a sustainable financial institution that empowers individuals and businesses to reach their full potentials, while delivering excellent returns to our investors.</p>
                            <a href="{{ route('homePage') }}" class='btn btn-primary'>
                                <span class='pr-2'>Get Started</span>
                                <svg width="12" class='inlineBlock' height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_138_587)">
                                        <path d="M0 5.50002H10.2857M10.2857 5.50002L6 1.21252M10.2857 5.50002L6 9.78752" stroke="white" stroke-width="1.5"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_138_587">
                                            <rect width="12" height="10.29" fill="white" transform="translate(0 0.35498)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class='col-xl-6 col-lg-6 col-md-6'>
                        <div class='imgwrap'>
                            <img src="{{ asset('assets/images/home-banner.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</x-guest-layout>

