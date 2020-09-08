@extends('welcome')

@section('content')

    <div class="row p-5">
        @foreach($products as $product)
            <div class="col-lg-6 p-5 mb-3 product">
                <h2 class="pb-2">{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p class="price">{{ $product->price }} {{ $product->currency->currency_code }}
                    <button class="ml-3 btn btn-primary basket" type="button" data-productId="{{ $product->id }}"><span>kos</span></button>
                </p>
            </div>
        @endforeach
    </div>

@endsection
