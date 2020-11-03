@extends('.Admin.sideMenu')

@section('content')
    <section id="contents">
    <div class="container welcome">
        <h1 class="heading-lv1">Přehled objednávek</h1>
        <div class="table-app" id="product-table-app">
            <div class="table-wrapper">
                <table class="table" id="table">
                    <thead>
                        <tr class="table-head">
                            <th class="table-cell align-right">Jméno a Příjmení</th>
                            <th class="table-cell align-left">Datum objednávky</th>
                            <th class="table-cell align-right">Celková cena</th>
                            <th class="table-cell align-right">Produkty</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                        <tr class="table-row">
                            <td class="table-cell align-right">{{ $order->user->name }}</td>
                            <td class="table-cell align-right description">{{ $order->created_at }}</td>
                            <td class="table-cell align-right">{{ $order->total_price }}</td>
                            <td class="table-cell align-right">
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-success">
                                    <img class="pl-1" src="{{ URL::to('/images/icons/detail.svg') }}">
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /#no-results -->
            </div>
            <!-- /.table-wrapper -->
        </div>
        <!-- /.table-app -->
    </div>
    <!-- /.container -->
    </section>
    @endsection

