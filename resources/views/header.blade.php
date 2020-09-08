<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('index') }}">Produkty <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
    <div >
        <div class="heading cf">
            <a href="{{ route('shoppingCart') }}" class="continue">Nákupní košík
                <img class="pl-1" id="shoping_cart" src="{{ URL::to('/images/icons/cart.svg') }}">
                <span id="shoppingCartCounter">
                    {{ \Illuminate\Support\Facades\Session::has('cart') ?
                    \Illuminate\Support\Facades\Session::get('cart')->getTotalItems() : '' }}
                </span>
            </a>
        </div>
    </div>
</nav>
