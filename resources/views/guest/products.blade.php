<x-guest-layout activepage="product">

    @section('title', "Products")

    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
        .slider {
            height: 5px;
            position: relative;
            background: #ddd;
            border-radius: 5px;
        }
        .slider .progress {
            height: 100%;
            left: 25%;
            right: 25%;
            position: absolute;
            border-radius: 5px;
            background: #7da640;
        }
        .range-input {
            position: relative;
        }
        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            top: -5px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        input[type="range"]::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 50%;
            background: #7da640;
            pointer-events: auto;
            -webkit-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }
        input[type="range"]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #7da640;
            pointer-events: auto;
            -moz-appearance: none;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }
    </style>

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
                        @forelse ($products as $pro)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a href="{{ route('productDetails', [$pro->id, $pro->slug]) }}" class="image">
                                            <img class="pic-1" src="{{ $pro->image }}">
                                        </a>
                                        <ul class="product-links text-center">
                                            <li>
                                                <a @if($pro->isWish) style="background: #000066" @endif href="{{ route('addProToWishList', $pro->id) }}" data-tip="Add to Wishlist">
                                                    <i class="fa fa-heart" @if($pro->isWish) style="color: #fff" @endif></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title mb-3"><a href="{{ route('productDetails', [$pro->id, $pro->slug]) }}">{{ $pro->name }}</a></h3>
                                        <div class="price mb-3 d-flex justify-content-between">
                                            <div>{{ $curr.number_format($pro->sales_price) }}</div>
                                            @if($pro->old_price)
                                            <div class="oldprice"><del>{{ $curr.number_format($pro->old_price) }}</del></div>
                                            @endif
                                        </div>

                                        {{--  --}}
                                        <div class="isNotLoading isNotLoading{{ $pro->id }}">
                                            <a href="{{ route('addProductTocart', $pro->id) }}"  class="add-cart"><i class="fas fa-cart-plus"></i>Add to cart</a>
                                            {{-- <a href="javascript:()" onclick="addProductTocart({{ $pro->id }})" class="add-cart"><i class="fas fa-cart-plus"></i>Add to cart</a> --}}
                                        </div>
                                        <div class="isLoading isLoading{{ $pro->id }}">
                                            <a href="javascript:()" class="add-cart "><i class="fa fa-spinner fa-spin"></i>Adding to cart...</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>

                    @if($products->total() > 0)
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                    @endif

                </div>

                <div class="col-xl-3">
                    <div class="card card-body filter p-2">
                        <div class="eachFilter mb-4">
                            <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">SEARCH</p>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control searchInput" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" onclick="submitSearch()">Go</button>
                                </div>
                            </div>
                        </div>

                        <div class="eachFilter">
                            <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">CATEGORIES</p>
                            @php $catcount = 1; @endphp
                            @forelse ($categories as $cat)
                            <div class="custom-control custom-checkbox mb-3" onclick="sortByCat('{{ $cat->slug }}')">
                                <input type="checkbox" class="custom-control-input" @if($theTypeValue == $cat->slug) checked @endif value="{{$cat->slug}}" id="{{$cat->slug}}{{ $catcount }}">
                                <label class="custom-control-label" for="{{$cat->slug}}{{ $catcount }}">{{$cat->category}}</label>
                            </div>
                            @php $catcount += 1; @endphp
                            @empty

                            @endforelse
                        </div>

                        <div class="eachFilter mt-4 mb-3">
                           <div class="d-flex justify-content-between bg-secondary text-white pt-2 pr-3 pb-2 pl-3">
                                <p class="mb-0">PRICE RANGE</p>
                                <p class="apply mb-0" onclick="submitPrice()" style="cursor: pointer">APPLY</p>
                            </div>

                            <div class="wrapper">
                                <div class="price-input d-flex justify-content-between mb-3 mt-3">
                                    <div class="field">
                                        <input type="number" class="input-min" value="0" style="height: 35px; width: 50px; text-align: center; padding: 0px">
                                    </div>
                                    <div style="text-align: center">
                                        <span>-</span>
                                    </div>
                                    <div class="field">
                                        <input type="number" class="input-max" value="{{ $maxPrice }}" style="height: 35px; width: 50px; padding: 0px; text-align: center">
                                    </div>
                                </div>
                                <div class="slider">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" class="range-min" min="0" max="{{ $maxPrice }}" value="0" step="100">
                                    <input type="range" class="range-max" min="0" max="{{ $maxPrice }}" value="{{ $maxPrice }}" step="100">
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>

        </section>

    </div>

    <script>
        function sortByCat(cat) {
            window.location = "{{ url('') }}/products/filter?type=category&value=" + cat;
        }
        function submitSearch(cat) {
            var input = document.querySelector('.searchInput').value;
            window.location = "{{ url('') }}/products/filter?type=search&value=" + input;
        }
        function submitPrice() {
            var from = document.querySelector('.input-min').value;
            var to = document.querySelector('.input-max').value;

            window.location = "{{ url('') }}/products/filter?type=price&value=" + from + "-" + to;
        }


    </script>

</x-guest-layout>

<script>
    const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    range = document.querySelector(".slider .progress");
    let priceGap = 1000;

    priceInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);

            if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                if (e.target.className === "input-min") {
                    rangeInput[0].value = minPrice;
                    range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                } else {
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                }
            }
        });
    });
    rangeInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);
            if (maxVal - minVal < priceGap) {
                if (e.target.className === "range-min") {
                    rangeInput[0].value = maxVal - priceGap;
                } else {
                    rangeInput[1].value = minVal + priceGap;
                }
            } else {
                priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
            }
        });
    });
</script>
