@extends('.Admin.sideMenu')

@section('content')
    <section id="contents">
    <div class="container welcome">
        <a class="btn btn-success mb-1" href="{{ route('product.create') }}">Vytvořit produkt</a>
        <h1 class="heading-lv1">Detail produktu {{ $product->name }}</h1>
        <div class="table-app" id="product-table-app">
            <div class="table-wrapper">
                <table class="table" id="table">
                    <thead>
                    <tr class="table-head">
                        <th class="table-cell align-right">ID</th>
                        <th class="table-cell align-left">Popis</th>
                        <th class="table-cell align-right">Cena</th>
                        <th class="table-cell align-right">Vytvořeno</th>
                        <th class="table-cell align-right">Naposledy upraveno</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr class="table-row">
                            <td class="table-cell align-right">{{ $product->id }}</td>
                            <td class="table-cell align-right">{{ $product->description }}</td>
                            <td class="table-cell align-right">{{ $product->price }}</td>
                            <td class="table-cell align-right">{{ $product->created_at }}</td>
                            <td class="table-cell align-right">{{ $product->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- /#no-results -->
                <div>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info">Upravit
                        <img class="pl-1" src="{{ URL::to('/images/icons/edit.svg') }}">
                    </a>
                    <a href="{{ route('product.destroy', $product->id) }}" class="btn btn-danger">
                        Smazat
                        <img class="pl-1" src="{{ URL::to('/images/icons/delete.svg') }}">
                    </a>
                </div>

            </div>
            <!-- /.table-wrapper -->
        </div>
        <!-- /.table-app -->
    </div>
    <!-- /.container -->
    </section>
    @endsection

