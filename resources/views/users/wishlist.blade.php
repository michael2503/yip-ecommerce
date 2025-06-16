<x-guest-layout activepage="wishlist">

    @section('title', "Wishlist")

    @section('description', "Welcome to Yip Online Ecommerce")
    @section('ogTitle', 'Welcome to Yip Online Ecommerce')
    @section('ogImage', asset('assets/images/yip-online.png'))
    @section('ogUrl', Request::url())


    <div class='productwrapper'>

        <section class='container'>

            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10"><x-success /></div>
            </div>

            <div class="row">
                <div class="col-xl-9">

                    <div class="row">
                        @forelse ($wishlists as $pro)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a href="{{ route('productDetails', [$pro->product->id, $pro->product->slug]) }}" class="image">
                                            <img class="pic-1" src="{{ $pro->product->image }}">
                                        </a>
                                        <ul class="product-links text-center">
                                            <li><a style="background: #000066" href="{{ route('addProToWishList', $pro->product->id) }}" data-tip="Add to Wishlist"><i class="fa fa-heart" style="color: #fff"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title mb-3"><a href="{{ route('productDetails', [$pro->product->id, $pro->product->slug]) }}">{{ $pro->product->name }}</a></h3>
                                        <div class="price mb-3 d-flex justify-content-between">
                                            <div>{{ $curr.number_format($pro->product->sales_price) }}</div>
                                            @if($pro->product->old_price)
                                            <div class="oldprice"><del>{{ $curr.number_format($pro->product->old_price) }}</del></div>
                                            @endif
                                        </div>

                                        {{--  --}}
                                        <div class="isNotLoading isNotLoading{{ $pro->product->id }}">
                                            <a href="{{ route('addProductTocart', $pro->product->id) }}"  class="add-cart"><i class="fas fa-cart-plus"></i>Add to cart</a>
                                            {{-- <a href="javascript:()" onclick="addProductTocart({{ $pro->product->id }})" class="add-cart"><i class="fas fa-cart-plus"></i>Add to cart</a> --}}
                                        </div>
                                        <div class="isLoading isLoading{{ $pro->product->id }}">
                                            <a href="javascript:()" class="add-cart "><i class="fa fa-spinner fa-spin"></i>Adding to cart...</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $wishlists->links() }}
                    </div>

                </div>

                <div class="col-xl-3"></div>
            </div>

        </section>

    </div>

</x-guest-layout>
