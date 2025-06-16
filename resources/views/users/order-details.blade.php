<x-guest-layout activepage="order">

    @section('title', "Order Details")

    @section('description', "Welcome to Yip Online Ecommerce")
    @section('ogTitle', 'Welcome to Yip Online Ecommerce')
    @section('ogImage', asset('assets/images/yip-online.png'))
    @section('ogUrl', Request::url())


    <div class='productwrapper'>
        <section class='container'>
            <div class="row d-flexx justify-content-center">
                <div class="col-xl-4 col-lg-4 col-md-5 mb-4">
                    <div class="eachSortSect">
                        <div class="d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                            <div class="widget-title">
                                <h6 class="title m-b30">Order Details</span></h6>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p>Order Number:</p>
                            <p>{{ strtoupper($order->order_number) }} </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Order Status:</p>
                            <p>
                                @if($order->status == 'pending')
                                <span class="bg-gray text-info" style="font-size: 13px">Pending</span>
                                @elseif($order->status == 'delivered')
                                <span class="bg-gray text-success" style="font-size: 13px">Delivered</span>
                                @elseif($order->status == 'cancelled')
                                <span class="bg-gray text-danger" style="font-size: 13px">{{ $order->status}}</span>
                                @elseif($order->status == 'processing')
                                <span class="bg-gray text-warning" style="font-size: 13px">{{ $order->status}}</span>
                                @elseif($order->status == 'shipped')
                                <span class="bg-gray text-info" style="font-size: 13px">{{ $order->status}}</span>
                                @endif
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Payment Method:</p>
                            <p>
                                @if ($order->payment_method == 'pay_now')
                                Instant Payment
                                @else
                                Pay on delivery
                                @endif
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Created On:</p>
                            <p>{{ date('d M, Y', strtotime($order->created_at)) }} </p>
                        </div>


                        <div class="d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                            <div class="widget-title">
                                <h6 class="title m-b30">Shipping Adress</span></h6>
                            </div>
                        </div>
                        <div class="">
                            <p class="mb-0">Address:</p>
                            <p>{{ $order->address }} </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>State:</p>
                            <p>{{ $order->state }} </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Country:</p>
                            <p>{{ $order->country }} </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Phone:</p>
                            <p>{{ $order->phone }} </p>
                        </div>

                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-7 mb-4">
                    {{-- I start here --}}
                    <div class="eachSortSect">
                        <div class="d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                            <div class="widget-title">
                                <h6 class="title m-b30">Products</span></h6>
                            </div>
                        </div>

                        @forelse ($products as $pro)
                        <div class="row orderDetails mb-4">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3 forcartImgDiv">
                                <img src="{{ $pro->image }}" class="cartimg" alt="/">
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-9">
                                <div class="dz-head">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="title mb-0">{{ $pro->name }}</h6>
                                    </div>
                                </div>
                                <div class="dz-body mt-3">
                                    <p class="mb-1 text-muted">
                                        <span>category:</span>
                                        {{ ucwords(str_replace('-', ' ', $pro->category)) }}
                                    </p>
                                    <p class="mb-1 text-muted">
                                        <span>Price:</span> {{ number_format($pro->price) }},
                                        <span>Qty:</span> {{ $pro->quantity }},
                                    </p>
                                    <p class="mb-1 text-muted">
                                        <span>Total Price:</span>
                                        {{ $curr }}{{ number_format($pro->price * $pro->quantity) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @empty

                        @endforelse

                        <div class="d-flex justify-content-end mb-2">
                            <div class="text-muted mr-4">Sub Total</div>
                            <div class="price">{{ $curr }}{{ number_format($order->total_amount) }}</div>
                        </div>
                        <div class="d-flex justify-content-end mb-2">
                            <div class="text-muted mr-4">Shipping Fee</div>
                            <div class="price">{{ $curr }}{{ number_format($order->shipping_fee) }}</div>
                        </div>
                        <div class="d-flex justify-content-end mb-2">
                            <div class="text-muted mr-4">Coupon</div>
                            <div class="price">Null</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end mb-4">
                            <div class="text-muted mr-4">Total</div>
                            <div class="price"><strong>{{ $curr }}{{ number_format($order->total_amount + $order->shipping_fee) }}</strong></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

</x-guest-layout>

