@extends('.Admin.sideMenu')

@section('content')
    <section id="contents">
    <div class="container welcome">
        <h1 class="heading-lv1">Produkty</h1>
        <a class="btn btn-success mb-1" href="{{ route('product.create') }}">Vytvořit produkt</a>
        <div class="table-app" id="product-table-app">
            <div class="table-wrapper">
                <table class="table" id="table">
                    <thead>
                    <tr class="table-head">
                        <th class="table-cell align-right">ID</th>
                        <th class="table-cell align-right">Název produktu</th>
                        <th class="table-cell align-left">Popis</th>
                        <th class="table-cell align-right">Cena</th>
                        <th class="table-cell align-right">Vytvořeno</th>
                        <th class="table-cell align-right">Naposledy upraveno</th>
                        <th class="table-cell align-right">Akce</th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                        <tr class="table-row">
                            <td class="table-cell align-right">{{ $product->id }}</td>
                            <td class="table-cell align-right">{{ $product->name }}</td>
                            <td class="table-cell align-right description">{{ $product->description }}</td>
                            <td class="table-cell align-right">{{ $product->price }}</td>
                            <td class="table-cell align-right">{{ $product->created_at }}</td>
                            <td class="table-cell align-right">{{ $product->updated_at }}</td>
                            <td class="table-cell align-right">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-success">
                                    <img class="pl-1" src="{{ URL::to('/images/icons/detail.svg') }}">
                                </a>
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info">
                                    <img class="pl-1" src="{{ URL::to('/images/icons/edit.svg') }}">
                                </a>
                                <a href="{{ route('product.destroy', $product->id) }}" class="remove_product">x</a>
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
    </section>
    @endsection

