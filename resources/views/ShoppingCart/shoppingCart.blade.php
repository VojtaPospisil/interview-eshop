@extends('welcome')

@section('content')
    @if(!empty($products))

        <div class="wrap cf">
            <div class="heading cf">
                <h1>Můj košík</h1>
                <a href="{{ route('index') }}" class="continue">Pokračovat v nákupu</a>
            </div>
            <div class="cart">
                <ul class="cartWrap">
                    @foreach($products as $product)
                        @if($loop->even)
                            <li class="items even">
                        @else
                            <li class="items odd">
                        @endif

                        <div class="infoWrap">
                            <div class="cartSection">
                                <img src="http://lorempixel.com/output/technics-q-c-300-300-4.jpg" alt="" class="itemImg" />
        {{--                        <p class="itemNumber">#QUE-007544-002</p>--}}
                                <h3>{{ $product['product']->name }}</h3>

{{--                                <p> <input type="text" value="{{ $product['totalProductQuantity'] }}" class="qty"/> x {{ $product['product']->price }} {{$product['product']->currency->currency_code}}</p>--}}
{{--                                <p> <input type="number" value="{{ $product['totalProductQuantity'] }}" class="qty"/> x {{ $product['product']->price }} {{$product['product']->currency->currency_code}}</p>--}}
                                <div class="number-spinner-sml spinner" data-productId="{{ $product['product']->id }}">
                                    <span class="ns-btn-sml">
                                        <a data-dir="dwn"><span class="icon-minus-sml"></span></a>
                                    </span>
                                    <input type="text" class="pl-ns-value" value="{{$product['totalProductQuantity']}}" maxlength=6>
                                    <span class="ns-btn-sml">
                                        <a data-dir="up"><span class="icon-plus-sml"></span></a>
                                    </span>
                                </div>
                                <div>
                                    <p> x {{ $product['product']->price }} {{$product['product']->currency->currency_code}}</p>
                                </div>
                                {{--                        <p class="stockStatus"> In Stock</p>--}}
                            </div>


                            <div class="prodTotal cartSection">
                                <p>{{ $product['totalProductPrice'] }} {{$product['product']->currency->currency_code}}</p>
                            </div>
                            <div class="cartSection removeWrap">
                                <a href="#" class="remove_product" data-productId="{{$product['product']->id}}">x</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="promoCode"><label for="promo">Have A Promo Code?</label><input type="text" name="promo" placholder="Enter Code" />
                <a href="#" class="btn"></a></div>

            <div class="subtotal cf">
                <ul>
        {{--            <li class="totalRow"><span class="label">Subtotal</span><span class="value">$35.00</span></li>--}}

        {{--            <li class="totalRow"><span class="label">Shipping</span><span class="value">$5.00</span></li>--}}

        {{--            <li class="totalRow"><span class="label">Tax</span><span class="value">$4.00</span></li>--}}
                    <li class="totalRow"><span class="label">Celkové množství</span><span class="value">{{ $totalQuantity }} Ks</span></li>
                    <li class="totalRow final"><span class="label">Celková cena</span><span class="value">{{ $totalPrice }}</span></li>
                    <div class="heading cf">
                        <li class="totalRow"><a href="#" class="btn continue"><button type="submit">Odelsat objednávku</button></a></li>
                    </div>
                </ul>
            </div>
        </div>

    @else
        <div id="empty_basket">
            <h1>Váš košík je prázdný</h1>
        </div>
    @endif

@endsection
