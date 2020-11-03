@extends('welcome')

@section('content')
    @if(!$orders->isEmpty())
        <h1>Přehled objednávek</h1>
        <div class="wrap cf">
            <div class="cart">
                <ul class="cartWrap">
                    @foreach($orders as $order)
                        <div class="tableDetail">
                        @if($loop->even)
                            <li class="items even">
                        @else
                            <li class="items odd">
                        @endif

                        <div class="infoWrap">
                            <div class="cartSection">
                                <h3>Datum vytvoření</h3>
                                <p>{{ $order->created_at }}</p>
                            </div>
                            <div class="prodTotal cartSection">
                                <p>Celková cena: {{ $order->total_price }}</p>
                            </div>
                            <div class="cartSection orderDetail">
                                <a href="#" data-productId="">x</a>
                            </div>
                        </div>
                    </li>
                        <div class="orderDetailTable">
                            <table class="rwd-table">
                                <tbody>
                                    <tr>
                                        <th>Produkt</th>
                                        <th>Množství</th>
                                        <th>Cena</th>
                                        <th>Celková cena</th>
                                    </tr>
                                    @foreach($order->productOrder as $productOrder)
                                        <tr>
                                            <td>{{ $productOrder->product->name }}</td>
                                            <td>{{ $productOrder->quantity }}</td>
                                            <td>{{ $productOrder->product->price }}</td>
                                            <td>{{ $productOrder->products_price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
{{--                            <table>--}}
{{--                                <tr>--}}
{{--                                    <th>Produkt</th>--}}
{{--                                    <th>Množství</th>--}}
{{--                                    <th>Cena</th>--}}
{{--                                </tr>--}}
{{--                                @foreach($order->productOrder as $productOrder)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $productOrder->product->name }}</td>--}}
{{--                                        <td>{{ $productOrder->quantity }}</td>--}}
{{--                                        <td>{{ $productOrder->product->price }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            </table>--}}
                        </div>
            </div>
                    @endforeach
                </ul>
            </div>
        </div>

    @else
        <div id="empty_basket">
            <h1>Nemáte žádné objednávky</h1>
        </div>
    @endif

@endsection

