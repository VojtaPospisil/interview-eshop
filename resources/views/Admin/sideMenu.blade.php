@extends('.Admin.header')

@section('sideMenu')

    <aside class="side-nav" id="show-side-navigation1">
        <i class="fa fa-bars close-aside hidden-sm hidden-md hidden-lg" data-close="show-side-navigation1"></i>
        <div class="heading">
            <div class="info">
                <h3>Laravel project</h3>
            </div>
        </div>
        <ul class="categories">
            <li>
                <i class="fa fa-home fa-fw" aria-hidden="true"></i>
                <a href="{{ route('product.index') }}">Produkty</a>
                <ul class="side-nav-dropdown">
                    <li>
                        <a href="{{ route('product.create') }}">Vytvořit</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="categories">
            <li>
                <i class="fa fa-home fa-fw" aria-hidden="true"></i>
                <a href="{{ route('order.index') }}">Objednávky</a>
            </li>
        </ul>
    </aside>

    @yield('content')

@endsection

