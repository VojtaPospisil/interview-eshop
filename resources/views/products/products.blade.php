@extends('welcome')

@section('content')

    @include('products.productModal')

    <div class="row p-5">
        @foreach($products as $product)
            <div class="col-lg-6 p-5 mb-3 product">
                <h2 class="pb-2">{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>

                <div class="heading cf">
                    <p class="price">{{ $product->price }} {{ $product->currency->currency_code }}</p>
                    <a href="{{ route('shoppingCart') }}" class="continue basket" data-toggle="modal"
                       data-target="#productModal"
                       data-productId="{{ $product->id }}"
                       data-productName="{{ $product->name }}"
                       data-description="{{ $product->description }}"
                       data-price="{{ $product->price }}"
                    >Do košíku</a>

                </div>

{{--                    <button class="ml-3 addToBasket" type="button" data-toggle="modal"--}}
{{--                            data-target="#productModal"--}}
{{--                            data-productId="{{ $product->id }}"--}}
{{--                            data-productName="{{ $product->name }}"--}}
{{--                            data-description="{{ $product->description }}"--}}
{{--                            data-price="{{ $product->price }}"--}}
{{--                    >Do košíku</button>--}}
{{--                </p>--}}
            </div>
        @endforeach
    </div>

    @include('products.productModal')

@endsection


