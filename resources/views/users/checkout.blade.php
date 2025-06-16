<x-guest-layout>


    <style>
        .forPayNow, .forPayLater{
            display: none
        }
    </style>

    <div class='productwrapper'>

        <section class='container'>

            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10"><x-success /></div>
            </div>


            <form action="{{ route('submitCheckout') }}" method="post" class="form" id="paymentForm">
                <input type="text" value="{{ Auth::user()->email }}" id="email-address" hidden>
                <input type="text" value="{{ $refNum }}" name="ref_number" id="getRef" hidden>
                @csrf

                <div class="row">
                    <div class="col-xl-8 col-lg-8 mb-4">
                        <div class="eachSortSect">
                            <div class="d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                                <div class="widget-title">
                                    <h6 class="title m-b30">Shipping Address</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="Country">Country</label>
                                        <input type="text" class="form-control" name="country" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="Country">State</label>
                                        <input type="text" class="form-control" name="state" required>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="Country">House number & street address</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="Country">Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="Country">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" required>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-4 d-flex justify-content-between bg-light pt-2 pl-3 pr-3 pb-1 mb-4">
                                <div class="widget-title">
                                    <h6 class="title m-b30">Payment Method</h6>
                                </div>
                            </div>

                            <div class="eachPay mb-4">
                                <div class="custom-control custom-radio" onchange="selectPayMethod('now')">
                                    <input type="radio" class="custom-control-input" id="customCheck" value="pay_now" name="payment_method">
                                    <label class="custom-control-label pl-3" for="customCheck">Pay Now</label>
                                </div>
                            </div>
                            <div class="eachPay">
                                <div class="custom-control custom-radio" onchange="selectPayMethod('later')">
                                    <input type="radio" class="custom-control-input" id="customCheck2" value="pay_on_delivery" name="payment_method">
                                    <label class="custom-control-label pl-3" for="customCheck2">Pay On Delivery</label>
                                </div>
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
                                <div class="price">{{ $curr }}{{ number_format($shipFee) }}</div>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <div class="text-muted">Coupon</div>
                                <div class="price">Null</div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <div class="text-muted">Total</div>
                                <div class="price"><strong>{{ $curr }}{{ number_format($overallTotal) }}</strong></div>
                            </div>

                            @if(session('cart'))
                                <div class="links-box mt-5">
                                    <button type="submit" onclick="payWithPaystack()" class="btn btn-primary btn-block forPayNow" title="">Checkout</button>
                                    <button class="btn btn-primary btn-block forPayLater">Checkout</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

        </section>

    </div>

</x-guest-layout>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    function selectPayMethod(param){
        console.log(param)
        payNow = document.querySelector('.forPayNow');
        payLater = document.querySelector('.forPayLater');
        if(param == 'later'){
            payLater.style.display = 'block';
            payNow.style.display = 'none';
        } else {
            payLater.style.display = 'none';
            payNow.style.display = 'block';
        }
    }

    function payWithPaystack() {
        var amt = '{{ $overallTotal }}' * 100;

        const paymentFormIntro = document.getElementById('paymentForm');
        paymentFormIntro.addEventListener("submit", payWithPaystackIntro, false);
        function payWithPaystackIntro(e) {
            e.preventDefault();

            let handler = PaystackPop.setup({
                key: 'pk_test_d929bbd3b478f8fe2b0ac9fa6b368d5b52eeceb5',
                email: document.getElementById("email-address").value,
                amount: amt,
                ref: document.getElementById("getRef").value,
                onClose: function(){
                    alert('Window closed.');
                },
                callback: function(response){
                    var getForm = document.getElementById('paymentForm');
                    getForm.submit();
                }
            });

            handler.openIframe();
        }
    }
</script>
