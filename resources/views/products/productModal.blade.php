{{--<!-- Button trigger modal -->--}}
{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--    Launch demo modal--}}
{{--</button>--}}

<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productName"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="productDescription"></p>
            </div>
            <div>
                <h3 class="pr-5 text-right" id="productPrice"></h3>
            </div>
            <div class="modal-footer">

                <form>
                    <div class="form-row align-items-center">
                        <input id="productId" type="hidden" value="">
                        <div class="number-spinner spinner">
                            <span class="ns-btn">
                                <a data-dir="dwn"><span class="icon-minus"></span></a>
                            </span>
                            <input id="quantity" type="text" class="pl-ns-value" value="1" maxlength=6>
                            <span class="ns-btn">
		                        <a data-dir="up"><span class="icon-plus"></span></a>
                            </span>
                        </div>
                        <input id="addToBasket" type="submit" class="number-submit">
{{--                        <div class="col-auto heading cf">--}}

{{--                            <button id="addToBasket" type="submit" class="btn btn-primary mb-2">Do košíku</button>--}}
{{--                        </div>--}}

{{--                        <div class="buy-box">--}}
{{--                            <div class="count-input">--}}
{{--                                <a class="incr-btn" data-action="decrease" href="#">&minus;</a>--}}
{{--                                <input type="text" name="quantity" id="frm-product-listCartForm-quantity" required data-nette-rules='[{"op":":filled","msg":"This field is required."},{"op":":min","msg":"Minimální počet kusů je 1.","arg":1}]' value="1" class="quantity">--}}
{{--                                <a class="incr-btn" data-action="increase" href="#">&plus;</a>--}}
{{--                            </div>--}}
{{--                            <input type="hidden" name="variant" value="176">--}}
{{--                            <input type="submit" name="_submit" value="Do košíku" class="">--}}
{{--                        </div>--}}
                    </div>
                </form>

{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
