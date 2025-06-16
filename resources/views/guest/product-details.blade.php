<x-guest-layout activepage="product">

    @section('title', $pro->name)

    @section('description', $pro->name)
    @section('ogTitle', $pro->name)
    @section('ogImage', $images[0]->image)
    @section('ogUrl', Request::url())

    <div class='productwrapper'>

        <section class='container'>

            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10"><x-success /></div>
            </div>

            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5">

                    <div class="slider-for imgWrap">
                        @forelse ($images as $img)
                        <div class="mb-3">
                            <img src="{{ $img->image }}" width="100%" alt="">
                        </div>
                        @empty

                        @endforelse
                    </div>

                    <div class="slider-nav mt-2">
                        @forelse ($images as $img)
                        <div class="mb-3">
                            <img src="{{ $img->image }}" width="90%" alt="">
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-7">
                    <div class="contWrap">
                        <h1 class="mb-3">{{ $pro->name }}</h1>
                        <p class="mb-2"><span class="text-muted">Category:</span> {{ ucwords(str_replace('-', ' ', $pro->category)) }}</p>
                        <p class="mb-2"><span class="text-muted">Brand:</span> {{ $pro->brand }}</p>
                        <p class="mb-2"><span class="text-muted">SKU:</span> {{ $pro->sku }}</p>
                        <h1 class="mt-5">
                            <span class="mr-4">{{ $curr.number_format($pro->sales_price) }}</span>
                            <small><small><del class="text-muted">{{ $curr.number_format($pro->old_price) }}</del></small></small>
                        </h1>

                        <hr class="mt-3 mb-3" />

                        <a href="{{ route('addProToWishList', $pro->id) }}" class="wishList mb-3 inlineBlock">
                            <i class="fa fa-heart"></i>
                            @if ($pro->isWish)
                                Remove from Wishlist
                            @else
                                Add to Wishlist
                            @endif
                        </a>

                        <div class="shareside mb-3 d-flex justify-content-start">
                            <p class="text-muted mr-3">Share to:</p>
                            <p>
                                @php
                                    $shareLink = Request::url();
                                @endphp
                                <a class="inlineBlock mr-3" href="https://www.facebook.com/share.php?u={{ $shareLink }}&description=" target="_blank"><img src="{{ asset('assets/images/f.png') }}" alt=""></a>
                                <a class="inlineBlock mr-3" href="https://twitter.com/intent/tweet/?text={{ $shareLink }}&url={{ $shareLink }}" target="_blank"><img src="{{ asset('assets/images/x.png') }}" alt=""></a>
                                <a class="inlineBlock mr-3" href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareLink }}&title={{ $shareLink }}&summary=&source={{ $shareLink }}" target="_blank"><img src="{{ asset('assets/images/l.png') }}" alt=""></a>
                            </p>
                        </div>
                        <a href="{{ route('addProductTocart', $pro->id) }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>

                <div class="col-xl-12 mt-4">
                    <div class="contWrap">
                        <h6 class="mb-4"><strong>DESCRIPTION</strong></h6>
                        {!! $pro->description !!}
                    </div>
                </div>
            </div>

        </section>

    </div>

</x-guest-layout>
<script>
     $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });

</script>
