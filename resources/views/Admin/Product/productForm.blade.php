@extends('.Admin.sideMenu')

@section('content')
    <section id="contents">
        <div class="container welcome">
            <div class="form">
                <div class="tab-content">
                    <div id="signup">
                        <div class="form">
                    @if($product->exists)
                        <h1>Upravit produkt</h1>
                        <form method="POST" action="{{ route('product.update',$product) }}">
                        @method('put')
                    @else
                        <h1>Vytvořit produkt</h1>
                        <form method="POST" action="{{ route('product.store') }}">
                    @endif
                            @csrf
                            <div class="field-wrap">
                                <label>Název
                                    <span class="req">*</span>
                                </label>
                                <input type="text"required autocomplete="off" name="name"
                                       value="{{ old('name', $product->name) }}"
                                       class="@error('name') border-red-500 @enderror">
                                @error('name')
                                <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field-wrap">
                                <label>Popis<span class="req">*</span></label>
                                <textarea type="textarea" required autocomplete="off" required name="description"
                                       class="@error('description') border-red-500 @enderror">
                                    {{ old('description', $product->description) }}
                                </textarea>
                                @error('description')
                                <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="field-wrap">
                                <label>Cena<span class="req">*</span></label>
                                <input type="text"required autocomplete="off" required name="price"
                                       value="{{ old('price', $product->price) }}"
                                       class="@error('price') border-red-500 @enderror">
                                @error('price')
                                <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="button button-block">Uložit</button>
                        </form>
                    </div>
                </div>
            </div><!-- tab-content -->
        </div> <!-- /form -->
    </section>

    @endsection
