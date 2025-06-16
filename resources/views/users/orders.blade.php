<x-guest-layout activepage="order">

    @section('title', "Orders")

    @section('description', "Welcome to Yip Online Ecommerce")
    @section('ogTitle', 'Welcome to Yip Online Ecommerce')
    @section('ogImage', asset('assets/images/yip-online.png'))
    @section('ogUrl', Request::url())


    <div class='productwrapper'>
        <section class='container'>
            <div class="row d-flexx justify-content-center">
                <div class="col-xl-8 col-lg-8 mb-4">
                    {{-- I start here --}}
                    <div class="eachSortSect">
                        <div class="d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                            <div class="widget-title">
                                <h6 class="title m-b30">All Order <span class="">({{ $orders->total() }})</span></h6>
                            </div>
                        </div>

                        @forelse ($orders as $order)
                        <div class="row orderDetails mb-4">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3 forcartImgDiv">
                                <img src="{{ json_decode($order->product_info)[0]->image }}" class="cartimg" alt="/">
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-9">
                                <div class="dz-head">
                                    <a href="{{ route('orderDetails', [$order->id, $order->order_number]) }}">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="title mb-0">ORDER - {{ strtoupper($order->order_number) }}</h6>
                                            <h6 class="title mb-0">{{ $curr }}{{ number_format($order->total_amount) }}</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="dz-body mt-3">
                                    <p class="mb-1 text-muted"><span>Created On: </span> {{ date('d M, Y', strtotime($order->created_at)) }}</p>
                                    <p class="mb-1 text-muted">
                                        <span>Payment Method:</span>
                                        @if ($order->payment_method == 'pay_now')
                                        Instant Payment
                                        @else
                                        Pay on delivery
                                        @endif
                                    </p>
                                    <p class="mb-1 text-muted">
                                        <span>Status:</span>

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
                            </div>
                        </div>
                        <hr>
                        @empty

                        @endforelse
                    </div>
                </div>

            </div>
        </section>

    </div>

</x-guest-layout>

