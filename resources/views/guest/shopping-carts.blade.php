<x-guest-layout activepage="carts">

    @section('title', "Shopping Cart")

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
                <div class="col-xl-8 col-lg-8 mb-4">
                    {{-- I start here --}}
                    <div class="eachSortSect">
                        <div class="d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                            <div class="widget-title">
                                @php $countCart = 0; @endphp

                                @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                @php $countCart += $details['quantity']; @endphp
                                @endforeach
                                @endif

                                <h6 class="title m-b30">Cart <span class="">({{ $countCart }})</span></h6>
                            </div>
                            <a href="{{ route('clearAllCart') }}" class="text-danger"><small><small><strong>CLEAR CART</strong></small></small></a>
                        </div>

                        @php $total = 0 @endphp
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp

                        <div class="row mb-4">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3 forcartImgDiv">
                                <img src="{{ $details['image'] }}" class="cartimg" alt="/">
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-9">
                                <div class="dz-head" data-id="{{ $id }}">
                                    <h6 class="title mb-0">{{ $details['name'] }}</h6>
                                </div>
                                <div class="dz-body">
                                    <div class="btn-quantity style-1 mt-3" style="width: 120px">
                                        <div class="input-group mb-3 input-group-sm" data-id="{{ $id }}" style="">
                                            <div class="input-group-prepend" onclick="updateCart('minus', {{ $id }})">
                                                <span class="input-group-text fa fa-minus mobilePlus" style="height: 31px"></span>
                                            </div>
                                            <input style="width: 50px; text-align: center; border-right: none" id="cartQty_{{ $id }}" value="{{ $details['quantity'] }}" readonly type="text" class="form-control">
                                            <div class="input-group-prepend" onclick="updateCart('plus', {{ $id }})">
                                                <span class="input-group-text fa fa-plus mobilePlus" style="height: 31px"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <h5 class="price mb-0">{{ $curr }}{{ number_format($details['price'] * $details['quantity']) }}</h5>
                                        <a href="javascript:void(0);" class="remove-from-cart"><i class="fa fa-trash text-danger"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach

                        <div class="order-detail">
                            <div class="d-flex justify-content-between">
                                <div>Sub Total</div>
                                <div class="price"><strong>{{ $curr }}{{ number_format($total) }}</strong></div>
                            </div>
                        </div>

                        @else

                        <h6 class="text-center mt-3">No Product</h6>

                        @endif

                        <div class="links-box mt-5 mb-3">
                            <a class="btn btn-primary bg-dark border-dark" href="{{ route('products') }}">
                                <span class="btn-txt">Continue Shopping</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4">
                    <div class="eachSortSect">
                        <div class="d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                            <div class="widget-title">
                                <h6 class="title m-b30">Summary</h6>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div class="text-muted">Sub Total</div>
                            <div class="price">{{ $curr }}{{ number_format($total) }}</div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="text-muted">Shipping Fee</div>
                            <div class="price">Null</div>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="text-muted">Coupon</div>
                            <div class="price">Null</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="text-muted">Total</div>
                            <div class="price"><strong>{{ $curr }}{{ number_format($total) }}</strong></div>
                        </div>

                         @if(session('cart'))
                            <div class="links-box mt-5">
                                <a class="btn btn-primary btn-block" href="{{ route('checkoutView') }}">
                                    Checkout
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </section>

    </div>

</x-guest-layout>

<script>
    function updateCart(param, cartID) {
        var cartQty = document.querySelector('#cartQty_'+ cartID).value;

        var qty = parseInt(cartQty) - 1;
        if(param == 'plus'){
            qty = parseInt(cartQty) + 1;
        }
        $.ajax({
            url: '{{ route('updateProductCart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: cartID,
                quantity: qty
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
</script>
