@extends('.Admin.sideMenu')

@section('content')
    <section id="contents">
    <div class="container welcome">
        <h1 class="heading-lv1">Jméno a Příjmení - {{ $order->user->name }}</h1>
        <div class="table-app" id="product-table-app">
            <div class="table-wrapper">
                <table class="table" id="table">
                    <thead>
                    <tr class="table-head">
                        <th class="table-cell align-right">Produkt</th>
                        <th class="table-cell align-left">Cena produktu</th>
                        <th class="table-cell align-right">Počet kusů</th>
                        <th class="table-cell align-right">Celková cena</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($order->productOrder as $productOrder)
                        <tr class="table-row">
                            <td class="table-cell align-right">{{ $productOrder->name }}</td>
                            <td class="table-cell align-right">{{ $productOrder->product->price }}</td>
                            <td class="table-cell align-right">{{ $productOrder->quantity }}</td>
                            <td class="table-cell align-right">{{ $productOrder->products_price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h5 class="heading-lv1">Celková cena - {{ $order->total_price }}</h5>
                <h5 class="heading-lv1">Datum objednávky - {{ $order->created_at }}</h5>
            </div>
            <!-- /.table-wrapper -->
        </div>
        <!-- /.table-app -->
    </div>
    <!-- /.container -->
    </section>
    @endsection

