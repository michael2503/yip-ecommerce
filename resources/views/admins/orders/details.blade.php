<x-admin-app-layout>


    <h2>Orders</h2>
    <hr>


    <section class='container'>
        <div class="row d-flexx justify-content-center mt-4">
            <div class="col-xl-4 col-lg-4 col-md-5 mb-4">
                <div class="eachSortSect card card-body p-2">
                    <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">ORDER DETAILS</p>

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


                    <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">SHIPPING ADDRESS</p>
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

                <div class="eachSortSect card card-body p-2 mt-4">
                    <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">ORDER STATUS</p>
                    {{-- @if($order->payment_method == 'pay_now')
                    <div class="d-flex justify-content-between">
                        <p>Payment Status:</p>
                        <p>
                            <span class="text-danger">Paid</span>
                        </p>
                    </div>
                    @endif
                    @if($order->payment_method == 'pay_on_delivery')
                    <p style="cursor: pointer" data-toggle="modal" data-target="#markAsPaid" class="text-success">Click here to mark this order as paid</p>
                    @endif --}}

                    <div class="form-group">
                        <label for="">Change order status</label>
                        <select onchange="changeOrderStatus({{ $order->id }})" name="status"  id="ordStatus" class="form-control custom-select">
                            <option @if($order->status == 'pending') selected @endif value="pending">Pending</option>
                            <option @if($order->status == 'processing') selected @endif value="processing">Processing</option>
                            <option @if($order->status == 'shipped') selected @endif value="shipped">Shipped</option>
                            <option @if($order->status == 'delivered') selected @endif value="delivered">Delivered</option>
                            <option @if($order->status == 'cancelled') selected @endif value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-7 mb-4">
                {{-- I start here --}}
                <div class="eachSortSect card card-body p-2">
                    <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">PRODUCTS</p>

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


{{--
    <div class="modal" id="markAsPaid">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body text-center">
                    <form action="{{ route('markAsPaid') }}" method="post">
                        @csrf
                        @method('PATCH')

                        <p class="mt-3">Are you sure you want to mark this order as paid?</p>
                        <div class="mt-4 mb-3">
                            <button class="btn btn-success btn-sm mr-4">Yes</button>
                            <button class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

     <!-- The Modal -->
    <div class="modal fade" id="orderStatusMo">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">

                <form action="{{ route('updateOrderStatus') }}" method="post">
                    @csrf
                    @method('PATCH')

                    <!-- Modal body -->
                    <div class="modal-body text-center">
                        <p class="mt-3">Are you sure you want to <span id="theAction"></span> this order</p>
                        <input type="hidden" id="ordStaInputAct" name="staAction">
                        <input type="hidden" id="ordStaInputID" name="staID">

                        <div class="mt-4 mb-3">
                            <button class="btn btn-success btn-sm mr-4">Yes</button>
                            <button class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <script>
        function changeOrderStatus(orderID) {
            var htmlAction = document.getElementById('ordStatus').value;
            var toSubmit = document.getElementById('ordStatus').value;

            if(htmlAction == 'Pending'){
                htmlAction = 'Pend';
            } else if(htmlAction == 'Processing'){
                htmlAction = 'Process';
            }

            document.getElementById('theAction').innerHTML = htmlAction;
            document.getElementById('ordStaInputAct').value = toSubmit;
            document.getElementById('ordStaInputID').value = orderID;
            $('#orderStatusMo').modal();
        }
    </script>

</x-admin-app-layout>
